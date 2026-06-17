<?php

return [
    'request_did_not_contain' => 'The request did not contain a header named `ClubPago-Signature`.',
    'the_signature_found_header_name' => 'The signature :name found in the header named `ClubPago-Signature` is invalid. Make sure that 
            the `services.ClubPago.webhook_signing_secret` config key is set to the value you found on the ClubPago dashboard. If you are caching your config try running `php artisan clear:cache` to resolve the problem.',
    'clubpago_sign_secret_not_set' => 'The ClubPago webhook signing secret is not set. Make sure that the `ClubPago.settings` configured as required.',
    'invalid_clubpago_payload' => 'Invalid ClubPago Payload. Please check WebhookCall: :arg',
    'invalid_clubpago_invoice_code' => 'Invalid ClubPago Invoice Code. Please check WebhookCall: :arg',
    'invalid_clubpago_subscription' => 'Invalid ClubPago Subscription Reference. Please check WebhookCall: :arg',
    'invalid_clubpago_customer' => 'Invalid ClubPago Customer. Please check WebhookCall: :arg',
    'please_specify_amount_string' => 'Please specify amount as a string or float,.
             with decimal places (e.g. 10.00 to represent $10.00).',
];