<?php

//use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Specialty
//devuelven vistas
Route::get('/specialties', [App\Http\Controllers\SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/specialties/create', [App\Http\Controllers\SpecialtyController::class, 'create'])->name('specialties.create'); //form registro
Route::get('/specialties/{specialty}/edit', [App\Http\Controllers\SpecialtyController::class, 'edit'])->name('specialties.edit');
//gestiona el registro de nuevas especialidades
Route::post('/specialties', [App\Http\Controllers\SpecialtyController::class, 'store'])->name('specialties.store');//envío del form
//gestiona la edición de una especialidad determinada
Route::put('/specialties/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'update'])->name('specialties.update');
Route::delete('/specialties/{specialty}', [App\Http\Controllers\SpecialtyController::class, 'destroy'])->name('specialties.destroy');

/*Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/create', 'SpecialtyController@create'); //form registro
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
Route::post('/specialties', 'SpecialtyController@store'); //envío del form-->*/

//Doctors
Route::get('/doctors', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/create', [App\Http\Controllers\DoctorController::class, 'create'])->name('doctors.create'); //form registro
Route::get('/doctors/{doctor}/edit', [App\Http\Controllers\DoctorController::class, 'edit'])->name('doctors.edit');
//gestiona el registro de nuevas especialidades
Route::post('/doctors', [App\Http\Controllers\DoctorController::class, 'store'])->name('doctors.store');//envío del form
//gestiona lal edición de una especialidad determinada
Route::put('/doctors/{doctor}', [App\Http\Controllers\DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/doctors/{doctor}', [App\Http\Controllers\DoctorController::class, 'destroy'])->name('doctors.destroy');


//Patients
//Route::resources(['patients' => PatientController::class]);