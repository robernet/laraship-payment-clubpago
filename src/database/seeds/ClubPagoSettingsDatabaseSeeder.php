<?php

namespace Corals\Modules\Payment\ClubPago\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClubPagoSettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
            [
                'code' => 'payment_clubpago_notes',
                'type' => 'TEXTAREA',
                'category' => 'Payment',
                'label' => 'payment_clubpago_notes',
                'value' => 'El pago se debe realizar en cualquiera de las tiendas y establecimientos autorizados, llevando la referencia que se muestra en la liga de abajo.',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_url_auth',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_url_auth',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_url_references',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_url_references',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_url_barcode',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_url_barcode',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_url_payformat',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_url_payformat',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_user',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_user',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_live_password',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_live_password',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_x_origin',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_x_origin',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_user_agent',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_user_agent',
                'value' => 'CPAPI_AGNT_V1',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_mode',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_mode',
                'value' => 'true',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_url_auth',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_url_auth',
                'value' => 'https://qa.clubpago.site/auth/api/auth',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_url_references',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_url_references',
                'value' => 'https://qa.clubpago.site/referencegenerator/svc/generator',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_url_barcode',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_url_barcode',
                'value' => 'https://qa.clubpago.site/referencegenerator/svc/generator/barcode',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_url_payformat',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_url_payformat',
                'value' => 'https://qa.clubpago.site/referencegenerator/svc/generator/payformat',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_user',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_user',
                'value' => 'test_emisor950',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'code' => 'payment_clubpago_sandbox_password',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_clubpago_sandbox_password',
                'value' => 'WaRrO1212#',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
