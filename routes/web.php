<?php

use App\Http\Livewire\Equipments\EquipmentDetailForm;
use App\Http\Livewire\Equipments\Equipments;
use App\Http\Livewire\Equipments\Form as EquipmentForm;
use App\Http\Livewire\Equipments\Uploader\Uploader;
use App\Http\Livewire\Scanner\Scanner;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/scanner');
});

Route::get('/scanner', Scanner::class);
Route::get('equipments/{qrcode}', Equipments::class);
Route::get('equipments/{qrcode}/form/{equipment?}', EquipmentForm::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
