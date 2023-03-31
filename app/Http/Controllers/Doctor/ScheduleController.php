<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    private $days = [
        'Lunes', 'Martes', 'Miércoles',
        'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];

    public function edit()
    {
        $workDays = WorkDay::where('user_id', auth()->id())->get();
        $workDays->map(function ($workDay){
            $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
            $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
            $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
            $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
            return $workDay;
        });
        //dd($workDays->toArray());
        $days = $this->days;
        return view('schedule', compact('workDays', 'days'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $active = $request->input('active') ?: [];//si esto es null, entonces "?" asigna este valor "[]" a la variable activa
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

    $errors = [];
    for ($i=0; $i<7 ; $i++) {
        if ($morning_start[$i] > $morning_end[$i]) {
            $errors []= 'Las horas del turno mañana son inconsistentes para el día ' . $this->days[$i] . '.';
        }
        if ($afternoon_start[$i] > $afternoon_end[$i]) {
            $errors []= 'Las horas del turno tarde son inconsistentes para el día ' . $this->days[$i] . '.';
        }
        WorkDay::updateOrCreate([
            'day' => $i,
            'user_id' => auth()->id()
            ], [
            'active' => in_array($i, $active),
            //está buscando el día i en el arreglo actual ya que active contiene que días están activos.

            'morning_start' => $morning_start[$i],
            'morning_end' => $morning_end[$i],

            'afternoon_start' => $afternoon_start[$i],
            'afternoon_end' => $afternoon_end[$i],
            ]);
    }
    if (count($errors) > 0)
    return back()->with(compact('errors'));
    //cuando hacemos un return back o un return redirect, la variable no se está inyectando sobre una vista sino que se está pasando a otra ruta con información.

    $notification = 'Los cambios se han guardado correctamente.';
    return back()->with(compact('notification'));
    }
    
}
