<?php

use App\Livewire\Employee\EditePost;
use App\Livewire\Employee\EmDashboard;
use App\Livewire\Employee\FindCar;
use App\Livewire\Employee\SeeDetails;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Landing;
use App\Livewire\Manager\CreateEmployee;
use App\Livewire\Manager\DeletedCarsList;
use App\Livewire\Manager\ManagerPanel;
use App\Livewire\MyLogin;
use App\Livewire\Settings\EmployeeSettings\EmployeePersonal;
use App\Livewire\Settings\MangerSettings\ManagerPersonal;
use Illuminate\Support\Facades\Route;

// Route::get('/', Landing::class)->name('home');

Route::get('/', MyLogin::class)->name('home');

Route::get('/car-image/{filename}', function ($filename) {
    $path = 'cars/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $mime = Storage::disk('public')->mimeType($path);

    return response($file, 200)->header('Content-Type', $mime);
})->where('filename', '.*')->name('car.image');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('/em-dashboard', EmDashboard::class)->middleware(['auth', 'verified'])
        ->name('ad_dash');

    Route::get('/details', SeeDetails::class)->name('detail');
    Route::get('/edite-post/{post_id}', EditePost::class)->name('edite');
    Route::get('/find-car/{n_car_id}', FindCar::class)->name('find_car');

    Route::get('/manager-panel', ManagerPanel::class)->middleware(['signed'])->name('mg-panel');
    Route::get('/manager-panel/create-employee', CreateEmployee::class)->middleware(['signed'])
        ->name('create-employee');

    Route::get('/setting/manager/personal', ManagerPersonal::class)
        ->middleware(['signed'])->name('mg-personal');
    Route::get('/setting/employee/personal', EmployeePersonal::class)
        ->middleware(['signed'])->name('em-personal');
    Route::get('/manager/deleted-cars-list', DeletedCarsList::class)
        ->middleware(['signed'])->name('del-cars-lst');

});

require __DIR__ . '/settings.php';
