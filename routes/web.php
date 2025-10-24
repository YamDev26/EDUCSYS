<?php

use Illuminate\Support\Facades\Route;

// Lien Activation Office => https://www.youtube.com/watch?v=m4ALRydYnb4 

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});


// Route App 
Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'student'], function() {
        Route::get('/index', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
        Route::post('/create', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
        Route::post('/import', [App\Http\Controllers\StudentController::class, 'import'])->name('student.import');
        Route::get('/export', [App\Http\Controllers\StudentController::class, 'export'])->name('student.export');
        Route::get('/search1', [App\Http\Controllers\StudentController::class, 'search1'])->name('student.search1');
        Route::get('/matricul', [App\Http\Controllers\StudentController::class, 'matricul'])->name('student.matricul');
        Route::get('/show/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
        Route::get('/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
        Route::put('/edit/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
        Route::get('/service', [App\Http\Controllers\StudentController::class, 'service'])->name('student.service');
    });

    Route::group(['prefix' => 'parametre'], function() {
        Route::get('/index', [App\Http\Controllers\ParametreController::class, 'index'])->name('tarif.index');
        Route::post('/store', [App\Http\Controllers\ParametreController::class, 'store'])->name('tarif.store');
        Route::get('/edit', [App\Http\Controllers\ParametreController::class, 'edit'])->name('tarif.edit');
        Route::post('/edit', [App\Http\Controllers\ParametreController::class, 'update'])->name('tarif.update');
        Route::post('/destroy', [App\Http\Controllers\ParametreController::class, 'destroy'])->name('tarif.destroy');
        Route::post('/create', [App\Http\Controllers\ParametreController::class, 'create'])->name('tarif.create');
        Route::get('/create', [App\Http\Controllers\ParametreController::class, 'search1'])->name('tarif.search1');
    });

    Route::group(['prefix' => 'payement'], function() {
        Route::get('/index', [App\Http\Controllers\PayementController::class, 'index'])->name('payement.index');
        Route::get('/create', [App\Http\Controllers\PayementController::class, 'create'])->name('payement.create');
        Route::get('/show/{id}', [App\Http\Controllers\PayementController::class, 'show'])->name('payement.show');
        Route::post('/store', [App\Http\Controllers\PayementController::class, 'store'])->name('payement.store');
        Route::get('/pdf/{str}', [App\Http\Controllers\PayementController::class, 'filePdf'])->name('payement.pdf');
        Route::get('/list', [App\Http\Controllers\PayementController::class, 'listView'])->name('payement.list');
    });
});
