<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Redirect root to login if not authenticated, otherwise to home
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/home', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::post('/dashboard/stop', [DashboardController::class, 'stop'])->name('dashboard.stop')->middleware('auth');
Route::get('/dashboard/timefs', [DashboardController::class, 'timefs'])->name('dashboard.timefs')->middleware('auth');
Route::post('/dashboard/start', [DashboardController::class, 'start'])->name('dashboard.start')->middleware('auth');
Route::post('/dashboard/pay', [DashboardController::class, 'pay'])->name('dashboard.pay')->middleware('auth');
Route::post('/dashboard/delete', [DashboardController::class, 'delete'])->name('dashboard.delete')->middleware('auth');
Route::post('/dashboard/edit-payment', [DashboardController::class, 'editPayment'])->name('dashboard.editPayment')->middleware('auth');
Route::post('/dashboard/delete-payment', [DashboardController::class, 'deletePayment'])->name('dashboard.deletePayment')->middleware('auth');
