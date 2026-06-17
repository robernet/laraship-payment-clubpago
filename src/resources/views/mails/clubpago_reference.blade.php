@extends('Notification::mail.master')

@section('body')
    {!! $body??'' !!}

    <div class="row">
        <div class="col-md-8">
            <p class="bg-info p-10 text-white">
                {!!  trans('ClubPago::labels.clubpago.order',['arg' => $order_number]) !!}<br />
                {!!  trans('ClubPago::labels.clubpago.folio',['arg' => $folio]) !!}<br />
                {!!  trans('ClubPago::labels.clubpago.date',['arg' => $fecha]) !!}<br />
                {!!  trans('ClubPago::labels.clubpago.amount',['arg' => $amount]) !!}<br />
                {!!  trans('ClubPago::labels.clubpago.reference',['arg' => $payment_reference]) !!}<br /><br />
                {!!  trans('ClubPago::labels.clubpago.pay_format',['arg' => $pay_format]) !!}<br />
            </p>
        </div>

    </div>
@endsection
