<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors')); 
    }

    public function create()
    {
        $specialties = Specialty::all();
       return view('doctors.create', compact('specialties')); 
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',
       ];
       $this->validate($request, $rules);
       //insertar nuevo registro | mass assignment
       $user = User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
        + [
         'role' => 'doctor',
         'password' => bcrypt($request->input('password'))  
        ]
       );

       $user->specialties()->attach($request->input('specialties'));

       $notification = 'Los datos del médico se han registrado correctamente.';
       return redirect('/doctors')->with(compact('notification'));
    }

    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        //especificar tabla intermedia specialties.id
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }

    public function update(Request $request, $id)
    {
       $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',
       ];
       $this->validate($request, $rules);

       $user = User::doctors()->findOrFail($id);
       //insertar nuevo registro | mass assignment
       $data = $request->only('name', 'email', 'cedula', 'address', 'phone');
       $password = $request->input('password');
       if($password)
        $data['password'] = bcrypt($password);
       
       //aquí se llenan los datos, objeto  php
       $user->fill($data);
       //consulta a la BD para hacer update
       $user->save(); //UPDATE

       $user->specialties()->sync($request->input('specialties'));

       $notification = 'La información del médico se ha actualizado correctamente.';
       return redirect('/doctors')->with(compact('notification'));
    }

    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();

        $notification = "El médico $doctorName se ha eliminado correctamente.";
        return redirect('/doctors')->with(compact('notification'));
    }
}
