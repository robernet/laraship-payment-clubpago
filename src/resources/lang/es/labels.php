<?php


return [
    'settings' => [
        'clubpago_notes' => 'Club Pago Notas',
        'clubpago_live_url_auth' => 'Club Pago Autentificación URL Activa',
        'clubpago_live_url_references' => 'Club Pago Generador de Referencias URL Activa',
        'clubpago_live_url_barcode' => 'Club Pago Generador de Código de Barras URL Activa',
        'clubpago_live_url_payformat' => 'Club Pago Generador de Formato de Pago URL Activa',
        'clubpago_live_user' => 'Club Pago Usuario Activo',
        'clubpago_live_password' => 'Club Pago Contraseña Activa',
        'clubpago_x_origin' => 'X-Origin',
        'clubpago_user_agent' => 'User-Agent',
        'clubpago_sandbox_mode' => 'Club Pago Modo Sandbox',
        'clubpago_sandbox_url_auth' => 'Club Pago Autentificación URL Sandbox',
        'clubpago_sandbox_url_references' => 'Club Pago Generador de Referencias URL Sandbox',
        'clubpago_sandbox_url_barcode' => 'Club Pago Generador de Código de Barras URL Sandbox',
        'clubpago_sandbox_url_payformat' => 'Club Pago Generador de Formato de Pago URL Sandbox',
        'clubpago_sandbox_user' => 'Club Pago Usuario Pruebas',
        'clubpago_sandbox_password' => 'Club Pago Contraseña Pruebas',

    ],
    'clubpago' => [
        'order' => '<span>Orden : <b>:arg</b></span>',
        'folio' => '<span>Folio : <b>:arg</b></span>',
        'date' => '<span>Fecha : <b>:arg</b></span>',
        'amount' => '<span>Monto : <b>:arg</b></span>',
        'reference' => '<span>Referencia : <b>:arg</b></span>',
        'bar_code' => '<span>Código de Barras : <a href=":arg" target="_blank"><b>:arg</b></a></span>',
        'pay_format' => '<span>Formato de Pago : <a class="btn btn-success" href=":arg" target="_blank"><b>Imprimir Referencia en PDF</b></a></span>',
        'delivery_notes' => 'Club Pago Account Information',
    ],
    'mail' => [
        'order' => 'Orden :',
        'folio' => 'Folio :',
        'date' => 'Fecha :',
        'amount' => 'Monto :',
        'payment_reference' => 'Referencia :',
        'bar_code' => 'Código de Barras :',
        'pay_format' => 'Formato de Pago :',
    ]

];