<?php

//use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//{{ route('home') }}

Route::middleware(['auth', 'admin'])->group(function () {
        //Specialty
    //devuelven vistas
    Route::get('/specialties', [App\Http\Controllers\Admin\SpecialtyController::class, 'index'])->name('specialties.index');
    Route::get('/specialties/create', [App\Http\Controllers\Admin\SpecialtyController::class, 'create'])->name('specialties.create'); //form registro
    Route::get('/specialties/{specialty}/edit', [App\Http\Controllers\Admin\SpecialtyController::class, 'edit'])->name('specialties.edit');
    //gestiona el registro de nuevas especialidades
    Route::post('/specialties', [App\Http\Controllers\Admin\SpecialtyController::class, 'store'])->name('specialties.store');//envío del form
    //gestiona la edición de una especialidad determinada
    Route::put('/specialties/{specialty}', [App\Http\Controllers\Admin\SpecialtyController::class, 'update'])->name('specialties.update');
    Route::delete('/specialties/{specialty}', [App\Http\Controllers\Admin\SpecialtyController::class, 'destroy'])->name('specialties.destroy');
        //Doctors
    Route::get('/doctors', [App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [App\Http\Controllers\Admin\DoctorController::class, 'create'])->name('doctors.create'); //form registro
    Route::get('/doctors/{doctor}/edit', [App\Http\Controllers\Admin\DoctorController::class, 'edit'])->name('doctors.edit');
    //gestiona el registro de nuevas especialidades
    Route::post('/doctors', [App\Http\Controllers\Admin\DoctorController::class, 'store'])->name('doctors.store');//envío del form
    //gestiona lal edición de una especialidad determinada
    Route::put('/doctors/{doctor}', [App\Http\Controllers\Admin\DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{doctor}', [App\Http\Controllers\Admin\DoctorController::class, 'destroy'])->name('doctors.destroy');
        //Patients
    Route::get('/patients', [App\Http\Controllers\Admin\PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [App\Http\Controllers\Admin\PatientController::class, 'create'])->name('patients.create'); //form registro
    Route::get('/patients/{patient}/edit', [App\Http\Controllers\Admin\PatientController::class, 'edit'])->name('patients.edit');
    //gestiona el registro de nuevas especialidades
    Route::post('/patients', [App\Http\Controllers\Admin\PatientController::class, 'store'])->name('patients.store');//envío del form
    //gestiona lal edición de una especialidad determinada
    Route::put('/patients/{patient}', [App\Http\Controllers\Admin\PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [App\Http\Controllers\Admin\PatientController::class, 'destroy'])->name('patients.destroy');
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/schedule', [App\Http\Controllers\Doctor\ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::post('/schedule', [App\Http\Controllers\Doctor\ScheduleController::class, 'store'])->name('schedule.store');
});

    Route::middleware('auth')->group(function (){
        Route::get('/appointments/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.create');
        Route::get('/appointments', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointments.store');

        // JSON
        Route::get('/specialties/{specialty}/doctors', [App\Http\Controllers\Api\SpecialtyController::class, 'doctor'])->name('specialties.doctor');
    });    

/*Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/create', 'SpecialtyController@create'); //form registro
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
Route::post('/specialties', 'SpecialtyController@store'); //envío del form-->*/