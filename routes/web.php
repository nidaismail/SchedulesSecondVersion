<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\StudUpdateController;

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
    return view('welcome');
});
// Route::get('/login/{id}', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Auth::routes();
    Route::get('/get-user-details/{userID}', [App\Http\Controllers\Auth\LoginController::class, 'getUserDetails']);
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   
    Route::post('/save', [App\Http\Controllers\HomeController::class, 'store'])->name('save');
    
    // Route::get('/index', [App\Http\Controllers\UserController::class, 'index']);
    //Route::get('//location-Check', [App\Http\Controllers\HomeController::class, 'check']); 
    
    Route::get('/viewdata', [App\Http\Controllers\UserdashboardController::class, 'preview'])->name('viewdata');
    Route::get('/view', [App\Http\Controllers\UserdashboardController::class, 'classview'])->name('view');
    
    Route::post('/admissible', [App\Http\Controllers\UserdashboardController::class, 'admissible'])->name('admissible');  
    
    Route::post('/check-location-availability', [App\Http\Controllers\HomeController::class,'checkLocationAvailability'])->name('check-location-availability');
  
    // Route::get('/create', [App\Http\Controllers\RolesController::class, 'index'])->name('create');
    // Route::get('/roles', [App\Http\Controllers\RolesController::class, 'show']);
    Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function() {
    Route::get('/admin', [App\Http\Controllers\AdmindashboardController::class, 'dataWithdate'])->name('dataWithdate');
    Route::get('/classadmin', [App\Http\Controllers\AdmindashboardController::class, 'dataWithclass'])->name('dataWithclass');
    Route::get('/locationadmin', [App\Http\Controllers\AdmindashboardController::class, 'dataWithlocation'])->name('dataWithlocation');
    Route::get('/weekadmin', [App\Http\Controllers\AdmindashboardController::class, 'dataOfWeek'])->name('dataOfWeek');
    Route::get('/getSchedules', [App\Http\Controllers\AdmindashboardController::class, 'getSchedules'])->name('getSchedules');
    Route::get('/class', [App\Http\Controllers\AdmindashboardController::class, 'dataWithLocation'])->name('class');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create']);
    // Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit']);
    Route::get('/show/{userID}', [App\Http\Controllers\UserController::class, 'show']);
    // Route::get('/destroy/{userID}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
    Route::get('/roles', [App\Http\Controllers\UserController::class, 'main']);
    // Route::get('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::get('edit-records', [App\Http\Controllers\AdmindashboardController::class, 'index']);
    Route::get('edit/{id}', [App\Http\Controllers\AdmindashboardController::class, 'show']);
    Route::post('edit/{id}', [App\Http\Controllers\AdmindashboardController::class, 'edit']);
    Route::get('delete-records', [App\Http\Controllers\UserdashboardController::class, 'index']);
    Route::delete('delete/{ids}', [App\Http\Controllers\UserdashboardController::class, 'deleteRecords'])->name('delete');
    Route::get('/otherFunctionality', [App\Http\Controllers\UserController::class, 'otherFunctionality'])->name('otherFunctionality');
        
});
Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
});
// Route::group(['middleware' => ['auth']], function() {
   
//     Route::resource('users', UserController::class);
    
// });

//Route::get('/admin', [App\Http\Controllers\AdmindashboardController::class, 'admindata']);
// Route::get('/next', [App\Http\Controllers\AdmindashboardController::class, 'nextdata'])->name('next');

