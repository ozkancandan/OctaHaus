<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return (new App\Http\Controllers\Calendar\HolidaysController())->index();
})->name("index");

Route::post('/get-holidays', function () {
    return (new App\Http\Controllers\Calendar\HolidaysController())->getHolidays();
})->name("get-holidays");

Route::post('/import-holidays', function () {
    return (new App\Http\Controllers\Calendar\HolidaysController())->import();
})->name("import-holidays");

Route::get('/calendar', function () {
    return (new App\Http\Controllers\Calendar\HolidaysController())->stored();
})->name("calendar");

Route::post('/calendar/update', function () {
    return (new App\Http\Controllers\Calendar\HolidaysController())->update();
})->name("calendar-update");
