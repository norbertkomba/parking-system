<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WebController;
use App\Models\Device;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCard;
use App\Models\VehicleCategory;
use App\Models\VehicleRate;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () { return view('auth.login'); });


Route::get('/dashboard', function () { return view('dashboard'); });
Route::get('/delete-data/{table}/{data}', [WebController::class, 'delete_data'])->middleware(['can:delete data']);
Route::get('/change-status/{table}/{data}/{colum}/{value}', [WebController::class, 'change_status']);
Route::get('card-device/card/get-details',[DeviceController::class,'GetDetailsFromArduino']);


Route::prefix("logs-access")->group(function() {
    Route::get('/manage-user/{user?}', function ($user = null) { return view('pages.logs-access.manage-user',['user' => User::find($user)]);})->name('user.manage');
    Route::post('/cu-user',[UserController::class,'UpdateCreateUser'])->name('user.cu-user');
    Route::get('/cu-password',[UserController::class,'ChangeUserPassword'])->name('user.cu-password');


    Route::get('/manage-role', function () { return view('pages.logs-access.manage-role');})->name('role.manage');
    Route::get('/user-role/{role?}', function ($role = null) { return view('pages.logs-access.create-update-role',['role' => Role::find($role)]);})->name('role.create-update');
    Route::post('/cu-user-role',[UserController::class,'UpdateCreateUserRole'])->name('role.cu-user-role');
});





Route::prefix('card-device')->group(function() {

    Route::prefix('/card')->group(function() {
        Route::get('/{card?}', function ($card = null) { return view('pages.card-device.manage-card',['card' => VehicleCard::find($card)]); })->name('card.manage');
        Route::post('/cu-card',[DeviceController::class,'UpdateCreateCard'])->name('card.cu-card');

    })->middleware('can:manage card');

    Route::prefix('/device')->group(function() {
        Route::get('/{device?}', function ($device = null) { return view('pages.card-device.manage-device',['device' => Device::find($device)]); })->name('device.manage');
        Route::post('/cu-device',[DeviceController::class,'UpdateCreateDevice'])->name('device.cu-device');
    })->middleware('can:manage device');

})->middleware(['can:manage device','manage card']);


Route::prefix('rate-category')->group(function() {

    Route::prefix('rate')->group(function() {
        Route::get('/{rate?}', function ($rate = null) { return view('pages.rate-category.manage-rate',['rate' => VehicleRate::find($rate)]); })->name('rate.manage');
        Route::post('/cu-rate',[VehicleController::class,'UpdateCreateRate'])->name('rate.cu-rate');
    })->middleware('can:manage rate');

    Route::prefix('category')->group(function() {
        Route::get('/{category?}', function ($category = null) { return view('pages.rate-category.manage-category',['category' => VehicleCategory::find($category)]); })->name('category.manage');
        Route::post('/cu-category',[VehicleController::class,'UpdateCreateCategory'])->name('category.cu-category');
    })->middleware('can:manage category');

})->middleware(['can:manage category','manage rate']);

Route::prefix('vehicle')->group(function() {

    Route::get('/registration/{vehicle?}', function ($vehicle = null) { return view('pages.vehicle.registration',['vehicle' => Vehicle::find($vehicle)]); })->name('vehicle.manage');
    Route::post('/cu-vehicle',[VehicleController::class,'UpdateCreateVehicle'])->name('vehicle.cu-vehicle');

    Route::get('/check-in', function () { return view('pages.vehicle.check-in'); })->name('vehicle.check-in');
    Route::get('/check-out', function () { return view('pages.vehicle.check-out'); })->name('vehicle.check-out');
    Route::get('/recharge',[VehicleController::class,'RechargeCardAmount'])->name('vehicle.recharge');
    Route::get('/details',[VehicleController::class,'getVehicleRecords'])->name('vehicle.records');

})->middleware(['can:manage vehicle']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
