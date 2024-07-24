<?php

use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Support\Carbon;
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
    return view('welcome');
})->name('home');

Route::get('/daftar', function () {
    return view('register');
})->name('register');

Route::get('/instansi', function () {
    return view('tenant-selection');
})->name('tenant-selection');

Route::get('/laporan/{tenant:token?}/{startPeriod?}/{endPeriod?}', function (?Tenant $tenant = null, string $startPeriod = null, string $endPeriod = null) {
    if (!$tenant && session('tenant.token')) {
        return redirect()->route('public-report', [
            'tenant' => session('tenant.token'),
        ]);
    }

    if (!$tenant) {
        return redirect()->route('tenant-selection');
    }

    $startPeriod = $startPeriod ?
        Carbon::createFromFormat('Y-m', $startPeriod) :
        Carbon::now();

    $endPeriod = $endPeriod ?
        Carbon::createFromFormat('Y-m', $endPeriod) :
        Carbon::now();

    return view('public-report', [
        'tenant' => $tenant,
        'startPeriod' => $startPeriod->startOfDay(),
        'endPeriod' => $endPeriod->endOfDay(),
    ]);
})->name('public-report');

Route::get('/survei/{tenant:token?}/{service?}', function (?Tenant $tenant = null, ?Service $service = null) {
    if (!$tenant && session('tenant.token')) {
        return redirect()->route('survey', [
            'tenant' => session('tenant.token'),
        ]);
    }

    if (!$tenant) {
        return redirect()->route('tenant-selection');
    }

    if (!$service) {
        return view('service-selection', [
            'tenant' => $tenant,
        ]);
    }

    return view('survey', [
        'tenant' => $tenant,
        'division' => $service->division,
        'service' => $service,
    ]);
})->name('survey');

Route::get('/survey-end/{tenant:token?}', function (?Tenant $tenant = null) {
    if (!$tenant) {
        return redirect()->route('home');
    }

    return view('survey-end', [
        'tenant' => $tenant,
    ]);
})->name('survey-end');
