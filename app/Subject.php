<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Subject extends Model
{
    protected $fillable = [
    	'name',
    	'start_time',
    	'end_time',
    	'learn_time',
    ];

    public function students()
    {
    	return $this->belongsToMany(Student::class)->withPivot('status')->withTimestamps();
    }
}
