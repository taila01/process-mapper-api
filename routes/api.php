<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ProcessDetailsController;

Route::prefix('v1')->group(function () {

    Route::get('/test', function () {
        return response()->json(['message' => 'Laravel e Next.js integrados!']);
    });

    Route::apiResource('sectors', SectorController::class);

    Route::get('/sector', [SectorController::class, 'index']);

    Route::apiResource('processes', ProcessController::class);

    Route::prefix('processes/{process}/details')->group(function () {
        Route::get('/', [ProcessDetailsController::class, 'show']);
        Route::post('/', [ProcessDetailsController::class, 'store']);
        Route::put('/', [ProcessDetailsController::class, 'update']);
        Route::delete('/', [ProcessDetailsController::class, 'destroy']);
    });

});
