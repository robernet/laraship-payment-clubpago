<?php

return [
    'name' => 'ClubPago',
    'key' => 'payment_clubpago',
    'support_subscription' => true,
    'support_ecommerce' => true,
    'support_marketplace' => true,
    'manage_remote_plan' => false,
    'manage_remote_product' => false,
    'manage_remote_sku' => false,
    'manage_remote_order' => false,
    'supports_swap' => false,
    'supports_swap_in_grace_period' => false,
    'require_invoice_creation' => false,
    'require_plan_activation' => false,
    'capture_payment_method' => false,
    'require_default_payment_set' => false,
    'can_update_payment' => false,
    'create_remote_customer' => false,
    'require_payment_token' => false,
    'default_subscription_status' => 'pending',
    'offline_management' => true,

    'settings' => [
        'notes' => [
            'label' => 'ClubPago::labels.settings.clubpago_notes',
            'type' => 'textarea',
            'required' => false,
        ],
        'live_url_auth' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_url_auth',
            'type' => 'text',
            'required' => false,
        ],
        'live_url_references' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_url_references',
            'type' => 'text',
            'required' => false,
        ],
        'live_url_barcode' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_url_barcode',
            'type' => 'text',
            'required' => false,
        ],
        'live_url_payformat' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_url_payformat',
            'type' => 'text',
            'required' => false,
        ],
        'live_user' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_user',
            'type' => 'text',
            'required' => false,
        ],
        'live_password' => [
            'label' => 'ClubPago::labels.settings.clubpago_live_password',
            'type' => 'text',
            'required' => false,
        ],
        'x_origin' => [
            'label' => 'ClubPago::labels.settings.clubpago_x_origin',
            'type' => 'text',
            'required' => false,
        ],
        'user_agent' => [
            'label' => 'ClubPago::labels.settings.clubpago_user_agent',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_mode' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_mode',
            'type' => 'boolean'
        ],
        'sandbox_url_auth' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_url_auth',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_url_references' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_url_references',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_url_barcode' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_url_barcode',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_url_payformat' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_url_payformat',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_user' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_user',
            'type' => 'text',
            'required' => false,
        ],
        'sandbox_password' => [
            'label' => 'ClubPago::labels.settings.clubpago_sandbox_password',
            'type' => 'text',
            'required' => false,
        ],

    ],
    'events' => [

    ],
    'webhook_handler' => '',
];