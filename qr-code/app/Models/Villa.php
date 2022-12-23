<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appintments()
    {
        return $this->hasMany(Appointment::class);
    }
}
