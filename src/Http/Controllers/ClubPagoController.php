<?php

namespace Corals\Modules\Payment\ClubPago\Http\Controllers;

use Carbon\Carbon;
use Corals\Foundation\Http\Controllers\PublicBaseController;
use Corals\Modules\Marketplace\Models\Order;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\Modules\Payment\Common\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ClubPagoController extends PublicBaseController
{
    public function consultaReferencia(Request $request): JsonResponse
    {
        $status = $this->verificaHeader($request);
        if ($status === 401) {
            return response()->json(['codigo' => 1, 'message' => 'Token Inválido'], 401);
        }
        if ($status === 403) {
            return response()->json(['codigo' => 2, 'message' => 'Origen Desconocido'], 403);
        }

        $referencia = $request->query('r');
        $transaction = ClubPagoReference::where('reference', $referencia)->first();

        if (!$transaction) {
            return response()->json([
                'codigo' => 3, 'monto' => 0, 'transaccion' => 0,
                'mensaje' => 'Referencia Desconocida', 'referencia' => $referencia,
            ]);
        }

        if ($transaction->status === 'pending') {
            return response()->json([
                'codigo'      => 0,
                'monto'       => (int) number_format($transaction->amount * 100, 0, '.', ''),
                'transaccion' => rand(0, 1000000),
                'mensaje'     => 'Transacción Exitosa',
                'referencia'  => $referencia,
            ]);
        }

        return response()->json([
            'codigo' => 13, 'monto' => 0, 'transaccion' => 0,
            'mensaje' => 'Referencia Sin Adeudo o Cancelada', 'referencia' => $referencia,
        ]);
    }

    public function pagoReferencia(Request $request): JsonResponse
    {
        $status = $this->verificaHeader($request);
        if ($status === 401) {
            return response()->json(['codigo' => 1, 'message' => 'Token Inválido'], 401);
        }
        if ($status === 403) {
            return response()->json(['codigo' => 2, 'message' => 'Origen Desconocido'], 403);
        }

        $referencia = $request->input('referencia');
        $transaction = ClubPagoReference::where('reference', $referencia)->first();

        if (!$transaction) {
            return response()->json([
                'codigo' => 3, 'monto' => 0, 'transaccion' => 0,
                'mensaje' => 'Referencia Desconocida', 'referencia' => $referencia,
            ]);
        }

        if ($transaction->status !== 'pending') {
            return response()->json([
                'codigo' => 13, 'monto' => 0, 'transaccion' => 0,
                'mensaje' => 'Referencia Sin Adeudo o Cancelada', 'referencia' => $referencia,
            ]);
        }

        $monto_recibido = $request->input('monto') / 100;
        if ($monto_recibido != $transaction->amount) {
            return response()->json([
                'codigo' => 30, 'monto' => 0, 'transaccion' => 0,
                'mensaje' => 'Monto Inválido', 'referencia' => $referencia,
            ]);
        }

        $orders = json_decode($transaction->orders_number, true);
        $orders_id = '';

        foreach ($orders as $order_id) {
            $order = Order::find($order_id);
            if (!$order) {
                return response()->json([
                    'codigo' => 50, 'monto' => 0, 'transaccion' => 0,
                    'mensaje' => 'Error de Sistema. Hable con su Proveedor', 'referencia' => $referencia,
                ]);
            }

            $orders_id .= 'ORD-' . sprintf('%06d', $order_id) . ',';
            $order->transactions()->update(['status' => 'completed']);
            $billing = $order->billing;
            $billing['payment_status'] = 'paid';
            $order->update(['status' => 'completed', 'billing' => $billing]);

            $invoice = Invoice::find($order->invoice->id);
            if ($invoice) {
                $invoice->update(['status' => 'paid']);
            }
        }

        $autorizacion = rand(10000000, 99999999);
        $transaccion = $request->input('transaccion');

        $transaction->update(['authorization' => $autorizacion, 'status' => 'paid']);

        return response()->json([
            'codigo'           => 0,
            'monto'            => $transaction->amount,
            'transaccion'      => $transaccion,
            'autorizacion'     => $autorizacion,
            'mensaje'          => 'Transacción Exitosa, Orden # ' . $orders_id,
            'notificacion_sms' => '',
            'mensaje_sms'      => '',
            'mensaje_ticket'   => '',
            'referencia'       => $referencia,
        ]);
    }

    public function cancelaPago(Request $request): JsonResponse
    {
        $status = $this->verificaHeader($request);
        if ($status === 401) {
            return response()->json(['codigo' => 1, 'message' => 'Token Inválido'], 401);
        }
        if ($status === 403) {
            return response()->json(['codigo' => 2, 'message' => 'Origen Desconocido'], 403);
        }

        $autorizacion = $request->input('autorizacion');
        $referencia = $request->input('referencia');
        $transaction = ClubPagoReference::where('reference', $referencia)->first();

        if (!$transaction) {
            return response()->json([
                'codigo' => 3, 'monto' => 0, 'transaccion' => 0,
                'mensaje' => 'Referencia Desconocida', 'referencia' => $referencia,
            ]);
        }

        if ($transaction->status !== 'paid') {
            return response()->json(['codigo' => 0, 'mensaje' => 'Cancelación Exitosa']);
        }

        if ($transaction->authorization != $autorizacion) {
            return response()->json(['codigo' => 61, 'mensaje' => 'Cancelación Fallida']);
        }

        $orders = json_decode($transaction->orders_number, true);

        foreach ($orders as $order_id) {
            $order = Order::find($order_id);
            if (!$order) {
                return response()->json([
                    'codigo' => 50, 'monto' => 0, 'transaccion' => 0,
                    'mensaje' => 'Error de Sistema. Hable con su Proveedor', 'referencia' => $referencia,
                ]);
            }

            $order->transactions()->update(['status' => 'pending']);
            $billing = $order->billing;
            $billing['payment_status'] = 'pending';
            $order->update(['status' => 'pending', 'billing' => $billing]);

            $invoice = Invoice::find($order->invoice->id);
            if ($invoice) {
                $invoice->update(['status' => 'pending']);
            }
        }

        $transaction->update(['status' => 'pending']);

        return response()->json(['codigo' => 0, 'mensaje' => 'Cancelación Exitosa']);
    }

    public function generarReferencia(float $monto): JsonResponse
    {
        $tokenData = $this->getClubPagoToken();
        if ($tokenData === null) {
            return response()->json(['error' => '401', 'message' => 'Token Inválido'], 401);
        }

        $orders = json_decode($this->ordenes(), true);
        $orders_id = '';
        foreach ($orders as $order_id) {
            $orders_id .= 'ORD-' . sprintf('%06d', $order_id) . ',';
        }

        $user = Auth::user();
        $descripcion = '[' . \Settings::get('site_name') . '] [' . $orders_id . ']';

        $responseBody = $this->requestReference(
            $user->id,
            $user->name . ' ' . $user->last_name,
            $user->email,
            $tokenData['Token'],
            $descripcion,
            $monto
        );

        $eval = json_decode($responseBody, true);

        ClubPagoReference::updateOrCreate(
            ['reference' => $eval['Reference']],
            [
                'orders_number' => $this->ordenes(),
                'amount'        => $monto,
                'currency'      => '',
                'authorization' => '',
                'bar_code'      => $eval['BarCode'],
                'pay_format'    => $eval['PayFormat'],
                'message'       => $eval['Message'],
                'folio'         => $eval['Folio'],
                'date'          => $eval['Date'],
                'status'        => 'pending',
                'user_id'       => $user->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        );

        event('notifications.clubpago.send_reference', [
            'user'              => $user,
            'order_number'      => $orders_id,
            'folio'             => $eval['Folio'],
            'fecha'             => $eval['Date'],
            'amount'            => $monto,
            'payment_reference' => $eval['Reference'],
            'pay_format'        => $eval['PayFormat'],
            'response'          => $responseBody,
        ]);

        return response()->json($eval);
    }

    public function getClubPagoToken(): ?array
    {
        $data = json_decode($this->authenticate(), true);

        return !empty($data['Token']) ? $data : null;
    }

    private function resolveBaseUrl(string $type): string
    {
        $isSandbox = \Settings::get('payment_clubpago_sandbox_mode', 'true') === 'true';
        $prefix = $isSandbox ? 'sandbox' : 'live';

        return \Settings::get("payment_clubpago_{$prefix}_{$type}");
    }

    private function resolveCredentials(): array
    {
        $isSandbox = \Settings::get('payment_clubpago_sandbox_mode', 'true') === 'true';
        $prefix = $isSandbox ? 'sandbox' : 'live';

        return [
            'user' => \Settings::get("payment_clubpago_{$prefix}_user"),
            'pswd' => \Settings::get("payment_clubpago_{$prefix}_password"),
        ];
    }

    private function authenticate(): string
    {
        return Http::post($this->resolveBaseUrl('url_auth'), $this->resolveCredentials())->body();
    }

    private function requestReference(int $userId, string $name, string $email, string $token, string $descripcion, float $monto): string
    {
        $dateStr = now()->format('YmdHis');
        $account = str_pad($dateStr, 15, '0', STR_PAD_LEFT) . str_pad((string) $userId, 7, '0', STR_PAD_LEFT);

        return Http::withToken($token)
            ->post($this->resolveBaseUrl('url_references'), [
                'Description'    => $descripcion,
                'Amount'         => $monto,
                'Account'        => $account,
                'CustomerEmail'  => $email,
                'CustomerName'   => $name,
                'ExpirationDate' => null,
            ])
            ->body();
    }

    private function verificaHeader(Request $request): int
    {
        if (!$request->hasHeader('X-Origin') || !$request->hasHeader('User-Agent')) {
            return 401;
        }

        $expectedOrigin = base64_encode(\Settings::get('payment_clubpago_x_origin'));
        $expectedAgent = \Settings::get('payment_clubpago_user_agent');

        if ($expectedOrigin !== $request->header('X-Origin')) {
            return 401;
        }

        if ($expectedAgent !== $request->header('User-Agent')) {
            return 403;
        }

        return 200;
    }

    private function ordenes(): string
    {
        $orders = [];

        foreach (\ShoppingCart::getInstances() as $instance) {
            $cart = \ShoppingCart::setInstance($instance);
            if ($cart->getAttribute('order_id')) {
                $orders[] = $cart->getAttribute('order_id');
            }
        }

        return json_encode($orders, JSON_FORCE_OBJECT);
    }
}
