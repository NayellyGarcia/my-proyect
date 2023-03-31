<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    public function users()
    {
        // $specialty-users
        return $this->belongsToMany(User::class);
    }
}
