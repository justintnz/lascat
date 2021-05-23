<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MclassController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/student', StudentController::class);
    Route::resource('/school', SchoolController::class);
    Route::resource('/class', MclassController::class);

    Route::get('/class/{school_id}/new', [MclassController::class, 'new'])->name('school.newclass');
    Route::post('/class/{school_id}/add', [MclassController::class, 'add'])->name('class.add');
    Route::get('/class/{id}/delete', [MclassController::class, 'delete'])->name('class.delete');

    Route::post('/student/{student_id}/register', [StudentController::class, 'register'])->name('student.registerclass');
    Route::get('/student/{student_id}/register',  function ($student_id) {
        return redirect('/student/' . $student_id . '/edit');
    });

    Route::get('/student/{class_id}/{student_id}/drop/', [StudentController::class, 'drop'])->name('student.dropclass');
});


require __DIR__ . '/auth.php';
