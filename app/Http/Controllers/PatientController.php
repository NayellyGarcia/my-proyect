<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //se usa where role para que solo se muestren esos roles ya definidos
        $patients = User::patients()->get();
        return view('patients.index', compact('patients')); 
    }

    public function create()
    {
       return view('patients.create'); 
    }

    public function store(Request $request)
    {
       //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
       //
    }

    public function destroy($id)
    {
        //
    }

}
