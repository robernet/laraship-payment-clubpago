<?php

use Corals\Modules\Payment\ClubPago\Http\Controllers\ClubPagoController;
use Illuminate\Support\Facades\Route;

Route::get('marketplace/clubpago-reference/{reference}', [ClubPagoController::class, 'consultaReferencia']);

Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], 'Service/PagoReferencia', [ClubPagoController::class, 'pagoReferencia']);
    Route::get('Service/ConsultaReferencia', [ClubPagoController::class, 'consultaReferencia']);
    Route::delete('Service/CancelaPago', [ClubPagoController::class, 'cancelaPago']);
});
