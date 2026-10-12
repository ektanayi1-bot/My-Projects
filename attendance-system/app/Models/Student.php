<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = ['classroom_id', 'roll_no', 'name'];
    public function classroom() { return $this->belongsTo(Classroom::class); }
}
