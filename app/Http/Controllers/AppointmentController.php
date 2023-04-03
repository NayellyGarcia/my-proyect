<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Appoinment;

class AppointmentController extends Controller
{
    public function create()
    {
        $specialties = Specialty::all();
        return view('appointments.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        //this->validate($request, $rules);
        $data = $request->only([
            'description',
            'specialty_id',
            'doctor_id',
            'patient_id',
            'schedule_date',
            'schedule_time',
            'type',
        ]);
        Appointment::create($data);

        $notification = 'La cita se ha registrado correctamente.';
        return back()->with(compact('notification'));
        // return redirect('/appoinments');
    }
}
