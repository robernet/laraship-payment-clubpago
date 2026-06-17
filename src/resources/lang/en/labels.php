<?php


return [
    'settings' => [
        'clubpago_notes' => 'Club Pago Notes',
        'clubpago_live_url_auth' => 'Club Pago Authentication Live URL',
        'clubpago_live_url_references' => 'Club Pago Reference Generator Live URL',
        'clubpago_live_url_barcode' => 'Club Pago Barcode Generator Live URL',
        'clubpago_live_url_payformat' => 'Club Pago Pay Format Generator Live URL',
        'clubpago_live_user' => 'Club Pago Live User',
        'clubpago_live_password' => 'Club Pago Live Password',
        'clubpago_x_origin' => 'X-Origin',
        'clubpago_user_agent' => 'User-Agent',
        'clubpago_sandbox_mode' => 'Club Pago Sandbox Mode',
        'clubpago_sandbox_url_auth' => 'Club Pago Authentication Sandbox URL',
        'clubpago_sandbox_url_references' => 'Club Pago Reference Generator Sandbox URL',
        'clubpago_sandbox_url_barcode' => 'Club Pago Barcode Generator Sandbox URL',
        'clubpago_sandbox_url_payformat' => 'Club Pago Pay Format Generator Sandbox URL',
        'clubpago_sandbox_user' => 'Club Pago Sandbox User',
        'clubpago_sandbox_password' => 'Club Pago Sandbox Password',

    ],
    'clubpago' => [
        'order' => '<span>Order : <b>:arg</b></span>',
        'folio' => '<span>Folio : <b>:arg</b></span>',
        'date' => '<span>Date : <b>:arg</b></span>',
        'amount' => '<span>Amount : <b>:arg</b></span>',
        'reference' => '<span>Reference : <b>:arg</b></span>',
        'bar_code' => '<span>Bar Code : <a href=":arg" target="_blank"><b>:arg</b></a></span>',
        'pay_format' => '<span>Formato de Pago : <a class="btn btn-success" href=":arg" target="_blank"><b>Print Reference in PDF</b></a></span>',

        'delivery_notes' => 'Club Pago Account Information',
    ],
    'mail' => [
        'order' => 'Order :',
        'folio' => 'Folio :',
        'date' => 'Date :',
        'amount' => 'Amount :',
        'payment_reference' => 'Reference :',
        'bar_code' => 'Bar Code :',
        'pay_format' => 'Pay Format :',
    ]

];