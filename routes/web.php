<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CliantController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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
});


Route::get('/index', function () {
    return view('index');
});

Route::middleware(['web', 'disableBackButton'])->group(function(){
    Route::middleware(['disableRedirectToLoginPage'])->group(function(){
        Route::get('/', [LoginController::class, 'login'])->name('index');
        Route::get('/index', [LoginController::class, 'login'])->name('index');
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('post/login', [LoginController::class, 'postLogin'])->name('post.login');
        Route::post('/arifin/tambah', [LoginController::class, 'store'])->name('post.store');
        Route::get('/create', [LoginController::class, 'create'])->name('create');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'admin'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [TablesController::class, 'profile'])->name('profile');
        Route::put('profile', [TablesController::class, 'upload'])->name('profile.update');
        // Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        // Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('book', [TablesController::class, 'index'])->name('tables');
        Route::get('user', [TablesController::class, 'users'])->name('user');
        Route::get('book/create', [TablesController::class, 'create'])->name('book.create');
        Route::post('book/store', [TablesController::class, 'store'])->name('book.store');
        Route::get('book/genre', [TablesController::class, 'genre'])->name('genre.create');
        Route::post('/genre/book', [TablesController::class, 'genres'])->name('genre.store');
        Route::get('book/show/{id}', [TablesController::class, 'show'])->name('book.show');
        Route::delete('book/delete/{id}', [TablesController::class, 'destroy'])->name('book.delete');
        Route::get('/book/{id}/edit', [TablesController::class, 'edit'])->name('book.edit');
        Route::put('/book/{barang}', [TablesController::class, 'update'])->name('book.update');
        Route::get('/search', [TablesController::class, 'search'])->name('search');
        // Route::get('book', [BarangController::class, 'index'])->name('barang');


        Route::get('pinjam', [PinjamController::class, 'index'])->name('pinjam.tables');
        Route::get('pinjam/create', [PinjamController::class, 'create'])->name('pinjam.create');
        Route::post('pinjam/store', [PinjamController::class, 'store'])->name('pinjam.store');
        Route::get('pinjam/genre', [PinjamController::class, 'genre'])->name('genre.create');
        Route::get('pinjam/show/{id}', [PinjamController::class, 'show'])->name('pinjam.show');
        Route::delete('pinjam/delete/{id}', [PinjamController::class, 'destroy'])->name('pinjam.delete');
        Route::get('/pinjam/{id}/edit', [PinjamController::class, 'edit'])->name('pinjam.edit');
        Route::put('/pinjam/{barang}', [PinjamController::class, 'update'])->name('pinjam.update');
        Route::post('pinjam/approve/{id}', [PinjamController::class, 'approve'])->name('pinjam.approve');
    });
});

    Route::prefix('cliant')->name('cliant.')->group(function(){
        Route::middleware(['auth:web', 'disableBackButton', 'cliant'])->group(function(){
            Route::get('dashboard', [DashboardController::class, 'cliant'])->name('cliant');
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('genre', [CliantController::class, 'genre'])->name('genre');
            Route::get('jenis', [CliantController::class, 'jenis'])->name('jenis');

            Route::get('cliant', [CliantController::class, 'index'])->name('tables');
            // Route::get('book/create', [TablesController::class, 'create'])->name('book.create');
            // Route::post('book/store', [TablesController::class, 'store'])->name('book.store');
            // Route::get('book/genre', [TablesController::class, 'genre'])->name('genre.create');
            // Route::post('/genre/book', [TablesController::class, 'genres'])->name('genre.store');
            Route::get('cliant/show/{id}', [CliantController::class, 'show'])->name('show');
            // Route::delete('book/delete/{id}', [TablesController::class, 'destroy'])->name('book.delete');
            // Route::get('/book/{id}/edit', [TablesController::class, 'edit'])->name('book.edit');
            // Route::put('/book/{barang}', [TablesController::class, 'update'])->name('book.update');
            // Route::get('/search', [TablesController::class, 'search'])->name('search');
            // // Route::get('book', [BarangController::class, 'index'])->name('barang');


            // Route::get('pinjam', [PinjamController::class, 'index'])->name('pinjam.tables');
            // Route::get('pinjam/create', [PinjamController::class, 'create'])->name('pinjam.create');
            // Route::post('pinjam/store', [PinjamController::class, 'store'])->name('pinjam.store');
            // Route::get('pinjam/genre', [PinjamController::class, 'genre'])->name('genre.create');
            // Route::get('pinjam/show/{id}', [PinjamController::class, 'show'])->name('pinjam.show');
            // Route::delete('pinjam/delete/{id}', [PinjamController::class, 'destroy'])->name('pinjam.delete');
            // Route::get('/pinjam/{id}/edit', [PinjamController::class, 'edit'])->name('pinjam.edit');
            // Route::put('/pinjam/{barang}', [PinjamController::class, 'update'])->name('pinjam.update');
            // Route::post('pinjam/approve/{id}', [PinjamController::class, 'approve'])->name('pinjam.approve');


        Route::get('pinjam/{id}', [CliantController::class, 'pinjam'])->name('pinjam');
        Route::post('store', [CliantController::class, 'store'])->name('store');
        });
    });
