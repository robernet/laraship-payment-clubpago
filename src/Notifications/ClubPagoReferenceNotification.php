<?php

namespace Corals\Modules\Payment\ClubPago\Notifications;

use Corals\Modules\Payment\ClubPago\Mails\ClubPagoReferenceEmail;
use Corals\User\Communication\Classes\CoralsBaseNotification;

class ClubPagoReferenceNotification extends CoralsBaseNotification
{
    /**
     * @param null $subject
     * @param null $body
     * @return OrderReceivedEmail|null
     */
    protected function mailable($subject = null, $body = null)
    {
        $order_number = $this->data['order_number'];
        $folio = $this->data['folio'];
        $fecha = $this->data['fecha'];
        $amount = $this->data['amount'];
        $payment_reference = $this->data['payment_reference'];
        $pay_format = $this->data['pay_format'];

        return new ClubPagoReferenceEmail($order_number, $amount, $payment_reference, $pay_format, $folio, $fecha, $subject, $body);
    }

    /**
     * @return mixed
     */
    public function getNotifiables()
    {
        return [];
    }

    public function getOnDemandNotificationNotifiables()
    {
        return [];
    }

    public function getNotificationMessageParameters($notifiable, $channel)
    {
        return [
            'order_number' => $this->data['order_number'],
            'folio' => $this->data['folio'],
            'date' => $this->data['fecha'],
            'amount' => $this->data['amount'],
            'payment_reference' => $this->data['payment_reference'],
            'pay_format' => url($this->data['pay_format']),
        ];
    }

    public static function getNotificationMessageParametersDescriptions()
    {
        return [
            'order_number' => trans('ClubPago::labels.mail.order'),
            'folio' => trans('ClubPago::labels.mail.folio'),
            'date' => trans('ClubPago::labels.mail.date'),
            'amount' => trans('ClubPago::labels.mail.amount'),
            'payment_reference' => trans('ClubPago::labels.mail.payment_reference'),
            'pay_format' => trans('ClubPago::labels.mail.pay_format'),
        ];
    }
}
