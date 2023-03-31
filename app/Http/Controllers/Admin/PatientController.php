<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //se usa where role para que solo se muestren esos roles ya definidos
        $patients = User::patients()->paginate(5);
        return view('patients.index', compact('patients')); 
    }

    public function create()
    {
       return view('patients.create'); 
    }

    public function store(Request $request)
    {
       $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'nullable|digits:8',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',
       ];
       $this->validate($request, $rules);
       //insertar nuevo registro | mass assignment
       User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
        + [
         'role' => 'patient',
         'password' => bcrypt($request->input('password'))  
        ]
       );
       $notification = 'El paciente se han registrado correctamente.';
       return redirect('/patients')->with(compact('notification'));
    }

    public function show($id)
    {
        //
    }

    public function edit(User $patient)
    {
        return view('patients.edit', compact('patient'));
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

       $user = User::patients()->findOrFail($id);
       //insertar nuevo registro | mass assignment
       $data = $request->only('name', 'email', 'cedula', 'address', 'phone');
       $password = $request->input('password');
       if($password)
        $data['password'] = bcrypt($password);
       
       //aquí se llenan los datos, objeto  php
       $user->fill($data);
       //consulta a la BD para hacer update
       $user->save(); //UPDATE

       $notification = 'La información del paciente se ha actualizado correctamente.';
       return redirect('/patients')->with(compact('notification'));
    }

    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = "El paciente $patientName se ha eliminado correctamente.";
        return redirect('/patients')->with(compact('notification'));
    }

}
