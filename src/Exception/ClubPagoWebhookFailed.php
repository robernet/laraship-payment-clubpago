<?php

namespace Corals\Modules\Payment\ClubPago\Exception;

use Corals\Modules\Payment\Common\Exception\WebhookFailed;
use Corals\Modules\Payment\Common\Models\WebhookCall;

class ClubPagoWebhookFailed extends WebhookFailed
{
    public static function missingSignature()
    {
        return new static(trans('ClubPago::exception.request_did_not_contain'));
    }

    public static function invalidSignature($signature)
    {
        return new static(trans('ClubPago::exception.the_signature_found_header_name', ['name' => $signature]));
    }

    public static function signingSecretNotSet()
    {
        return new static(trans('ClubPago::exception.clubpago_sign_secret_not_set'));
    }

    public static function invalidClubPagoPayload(WebhookCall $webhookCall)
    {
        return new static(trans('ClubPago::exception.invalid_clubpago_payload', ['arg' => $webhookCall->id]));
    }

    public static function invalidClubPagoInvoice(WebhookCall $webhookCall)
    {
        return new static(trans('ClubPago::exception.invalid_clubpago_invoice_code', ['arg' => $webhookCall->id]));
    }

    public static function invalidClubPagoSubscription(WebhookCall $webhookCall)
    {
        return new static(trans('ClubPago::exception.invalid_clubpago_subscription', ['arg' => $webhookCall->id]));
    }

    public static function invalidClubPagoCustomer(WebhookCall $webhookCall)
    {
        return new static(trans('ClubPago::exception.invalid_clubpago_customer', ['arg' => $webhookCall->id]));
    }
}
