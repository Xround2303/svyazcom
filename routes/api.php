<?php

use App\Http\Controllers\ControllerBillList;
use App\Http\Controllers\ControllerSetting;
use App\Http\Controllers\ControllerPumpRecord;
use App\Http\Controllers\ControllerResident;
use App\Http\Controllers\ControllerTariff;
use App\Http\Response;
use Illuminate\Support\Facades\Route;

Route::resource("resident", ControllerResident::class)->except([
    "edit", "show"
]);
Route::resource("tariff", ControllerTariff::class)->except([
    "show"
]);
Route::get("/bills", ControllerBillList::class);
Route::get("/setting", [ControllerSetting::class, "list"]);
Route::post("/setting", [ControllerSetting::class, "update"]);

Route::post("/set-volume-pump-record", ControllerPumpRecord::class);

Route::any('{any}', function(){
    return Response::json("route not found", 404);
})->where('any', '.*');
