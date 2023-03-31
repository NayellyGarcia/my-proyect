<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Specialty;

class SpecialtyController extends Controller
{
    public function doctors(Specialty $specialty)
    {
        //devolución de colección de objetos donde cada objeto representa un médico que está asociado con esta especialidad.
        //return: cuando detecta que un método devuelve una colección y la transforma automáticamente en JSON.
        return $specialty->users;
    }
}
