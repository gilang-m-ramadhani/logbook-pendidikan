<?php

use App\Models\Test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Mahasiswa\LogbookController;



    Route::get('/', function () {
        return view('welcome');
});

// routes/web.php

    Route::middleware(['auth', 'role:mahasiswa'])->group(function () {


    Route::get('/tests/{test}/take', function (Test $test) {
        return view('mahasiswa.take-test', ['test' => $test]);
    })->name('mahasiswa.tests.take');

    Route::post('/tests/{test}/submit', [TestController::class, 'submit'])
        ->name('mahasiswa.tests.submit');


    });
