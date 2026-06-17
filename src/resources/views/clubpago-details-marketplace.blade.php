@php
//    if (!is_null(session('response')) {
//        $response = session('response');
//    } else {
        $response = app('Corals\Modules\Payment\ClubPago\Http\Controllers\ClubPagoController')->generarReferencia($amount*100);
//        session(['response', $response]);
//    }

    $payment_reference = "";
    $bar_code = "";
    $pay_format = "";
    $message = "";
    $folio = "";
    $fecha = "";

    $eval = json_decode($response, true);

    if (is_null($eval['Error']))
    {
        $payment_reference = $eval['Reference'];
        $bar_code = $eval['BarCode'];
        $pay_format = $eval['PayFormat'];
        $message = $eval['Message'];
        $folio = $eval['Folio'];
        $fecha = $eval['Date'];
    }
@endphp

@if (is_null($eval['Error']))
<div class="row">
    <div class="col-md-12">
        @php \Actions::do_action('pre_clubpago_checkout_form',$gateway) @endphp
        <form action="{{ url($action) }}" method="post" id="payment-form" class="ajax-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel-body bg-primary clubpago-info p-10 text-white"> {!! $gateway->getClubPagoNotes() !!}</div>
                    <p class="bg-info p-10 text-white">
                        {!!  trans('ClubPago::labels.clubpago.folio',['arg' => $folio]) !!}<br />
                        {!!  trans('ClubPago::labels.clubpago.date',['arg' => $fecha]) !!}<br />
                        {!!  trans('ClubPago::labels.clubpago.amount',['arg' => $amount]) !!}<br />
                        {!!  trans('ClubPago::labels.clubpago.reference',['arg' => $payment_reference]) !!}<br /><br />
                        {!!  trans('ClubPago::labels.clubpago.pay_format',['arg' => $pay_format]) !!}<br />
                    </p>

                    <input type='hidden' name='clubpagoExtra' value='{"bar_code": "{{ $bar_code }}", "pay_format": "{{ $pay_format }}", "folio": "{{ $folio }}", "fecha": "{{ $fecha }}"}'/>
                    <input type='hidden' name='checkoutToken' value='{{ $payment_reference  }}'/>
                    <input type='hidden' name='gateway' value='ClubPago'/>
                </div>

            </div>
        </form>
    </div>

</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="panel-body bg-primary clubpago-info p-10 text-white">ERROR EN LA TRANSACCIÓN CON CLUBPAGO</div>
                <p>Error: {{ $eval['Error'] }}</p>
                <p>Mensaje: {{$eval['Message']}}</p>
            </div>
        </div>
    </div>
</div>
@endif