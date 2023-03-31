<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    // $specialty-users
    public function users()
    {   //withTimestamps agrega valor de created y updated al registro
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
