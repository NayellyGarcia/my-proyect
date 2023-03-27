<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::all();
        return view('doctors.index', compact('doctors')); 
    }

    public function create()
    {
       return view('doctors.create'); 
    }
}
