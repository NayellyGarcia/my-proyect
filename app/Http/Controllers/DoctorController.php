<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

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
       return view('doctors.create'); 
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
         'role' => 'doctor',
         'password' => bcrypt($request->input('password'))  
        ]
       );
       $notification = 'Los datos del médico se han registrado correctamente.';
       return redirect('/doctors')->with(compact('notification'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
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
       
       //$user->fill o save($data);
       $user->fill($data);

       $notification = 'La información del médico se ha actualizado correctamente.';
       return redirect('/doctors')->with(compact('notification'));
    }

    public function destroy($id)
    {
        //
    }
}
