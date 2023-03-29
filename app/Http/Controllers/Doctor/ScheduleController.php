<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;

class ScheduleController extends Controller
{
    public function edit()
    {
        $days = [
            'Lunes', 'Martes', 'Miércoles',
            'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];
        return view('schedule', compact('days'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $active = $request->input('active') ?: [];//si esto es null, entonces "?" asigna este valor "[]" a la variable activa
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

    for ($i=0; $i<7 ; $i++)
        WorkDay::updateOrCreate(
            [
            'day' => $i,
            'user_id' => auth()->id()
            ],
            [
            'active' => in_array($i, $active),//está buscando el día i en el arreglo actual ya que active contiene que días están activos.

            'morning_start' => $morning_start[$i],
            'morning_end' => $morning_end[$i],

            'afternoon_start' => $afternoon_start[$i],
            'afternoon_end' => $afternoon_end[$i]
            ]
        );
    return back();
    }
}
