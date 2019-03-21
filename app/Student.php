<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\User;

class Student extends Model
{
    protected $fillable = [
    	'mssv',
    	'name',
    	'class',
        'user_id',
    ];

    public function subjects()
    {
    	return $this->belongsToMany(Subject::class)->withPivot('status')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getStudentFromMssv($mssv)
    {
    	return Student::where('mssv', $mssv)->first();
    }

    public function checkRollcallByDay($day, $subject_id)
    {
        return $this->subjects()->whereDate('student_subject.created_at', $day)
            ->where('student_subject.subject_id', $subject_id)
            ->exists();
    }
}
