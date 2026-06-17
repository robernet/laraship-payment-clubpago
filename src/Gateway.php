<?php

namespace Corals\Modules\Payment\ClubPago;

use Corals\Modules\Payment\ClubPago\Exception\ClubPagoWebhookFailed;
use Corals\Modules\Payment\Common\AbstractGateway;
use Corals\Modules\Payment\Common\Models\WebhookCall;
use Corals\Modules\Payment\Payment;
use Corals\Modules\Subscriptions\Models\Plan;
use Corals\Modules\Subscriptions\Models\Subscription;
use Corals\User\Models\User;
use Illuminate\Http\Request;

class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'ClubPago';
    }

    public function getDefaultParameters(): array
    {
        return [
            'signature' => '',
        ];
    }

    public function setAuthentication(): void
    {
        $this->setClubPagoNotes(\Settings::get('payment_clubpago_notes'));
    }

    public function getPaymentViewName(?string $type = null): ?string
    {
        return match ($type) {
            'subscription' => 'ClubPago::clubpago-details',
            'ecommerce'    => 'ClubPago::clubpago-details-ecommerce',
            'marketplace'  => 'ClubPago::clubpago-details-marketplace',
            default        => null,
        };
    }

    public function getClubPagoNotes(): mixed
    {
        return $this->getParameter('ClubPagoNotes');
    }

    public function setClubPagoNotes(mixed $value): static
    {
        return $this->setParameter('ClubPagoNotes', $value);
    }

    public function getSignature(): mixed
    {
        return $this->getParameter('signature');
    }

    public function setSignature(mixed $value): static
    {
        return $this->setParameter('signature', $value);
    }

    public function createSubscription(array $parameters = []): mixed
    {
        return $this->createRequest('\Corals\Modules\Payment\ClubPago\Message\CreateSubscriptionRequest', $parameters);
    }

    public function cancelSubscription(array $parameters = []): mixed
    {
        return $this->createRequest('\Corals\Modules\Payment\ClubPago\Message\CancelSubscriptionRequest', $parameters);
    }

    public function prepareCustomerParameters(User $user, array $extra = []): array
    {
        $parameters['customerData'] = [
            'description'        => $user->full_name,
            'email'              => $user->email,
            'name'               => $user->full_name,
            'MerchantCustomerId' => $user->id,
        ];

        $result = explode('|', $extra['checkoutToken'] ?? '');
        if (count($result) === 2) {
            [$data_value, $data_descriptor] = $result;
            $parameters['customerData']['DataDescriptor'] = $data_descriptor;
            $parameters['customerData']['DataValue'] = $data_value;
        }

        if ($user->integration_id) {
            [$customer_profile_id, $customer_payment_profile_id] = explode('|', $user->integration_id);
            $parameters['customerData']['customerProfileId'] = $customer_profile_id;
            $parameters['customerData']['customerPaymentProfileId'] = $customer_payment_profile_id;
        }

        $parameters['customerData']['billAddress'] = $extra['billing_address'] ?? [];

        return $parameters;
    }

    public function userRequirePayment(User $user): bool
    {
        return true;
    }

    public function prepareSubscriptionParameters(Plan $plan, User $user, ?Subscription $subscription = null, mixed $subscription_data = null): array
    {
        $parameters['subscriptionData']['subscription_reference'] = session()->get('checkoutToken');
        session()->forget('checkoutToken');

        return $parameters;
    }

    public function prepareSubscriptionCancellationParameters(User $user, Subscription $current_subscription): array
    {
        return [
            'SubscriptionCancellationData' => [
                'subscriptionId' => $current_subscription->subscription_reference,
            ],
        ];
    }

    public static function webhookHandler(Request $request): mixed
    {
        $webhookCall = null;

        try {
            $eventPayload = $request->getContent();

            if (!static::validate($eventPayload, $request->header('X-Anet-Signature'))) {
                throw ClubPagoWebhookFailed::invalidSignature($request->header('X-Anet-Signature'));
            }

            $eventPayload = json_decode($eventPayload, true);

            $webhookCall = WebhookCall::create([
                'event_name' => 'clubpago.' . $eventPayload['eventType'],
                'payload'    => $eventPayload['payload'],
                'gateway'    => 'ClubPago',
            ]);

            $webhookCall->process();

            return response('', 200);
        } catch (\Exception $exception) {
            if ($webhookCall) {
                $webhookCall->saveException($exception);
            }
            log_exception($exception, 'Webhooks', 'clubpago');

            return response('', 500);
        }
    }

    public static function validate(string $payload, ?string $AnetSignature): bool
    {
        if (empty($AnetSignature)) {
            return false;
        }

        $gateway = Payment::create('ClubPago');
        $gateway->setAuthentication();

        $parts = explode('=', $AnetSignature);
        $algorithm = $parts[0];

        if ($algorithm !== 'sha512') {
            return false;
        }

        $inSig = $parts[1] ?? '';
        $vSig = strtoupper(hash_hmac($algorithm, $payload, $gateway->getSignature()));

        return hash_equals($inSig, $vSig);
    }
}
