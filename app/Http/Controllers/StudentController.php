<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use File;
use Auth;

class StudentController extends Controller
{
    public function getResult(Request $request)
    {
        $student = Auth::user()->student;
        $subjects = Subject::pluck('name', 'id')->toArray();
        $month = Carbon::today()->format('m');
        $year = Carbon::today()->format('Y');
        $date = Carbon::today()->format('d');
        $defaultSubjectId = Subject::orderBy('created_at')->first()->id;
        $defaultSubjectName = Subject::orderBy('created_at')->first()->name;
        $defaultDay = $year . '-' . $month. '-' . ($date < 10 ? '0' : '') . $date;
        $data = $this->getData($student, $defaultSubjectId, $defaultDay);
        $defaultDay = Carbon::create($defaultDay)->format('d-m-Y');

        if ($request->ajax()) {
            $defaultSubjectId = $request->subject_id;
            $defaultDay = $request->day;
            $data = $this->getData($student, $defaultSubjectId, $defaultDay);

            return response()->json([
                'html' => count($data) ? view('table', compact('data'))->render() : [],
                'message' => 'successfully',
            ]);
        }

        return view('result', compact('data', 'student', 'subjects', 'defaultDay', 'defaultSubjectName'));
    }

    public function getData($student, $subjectId, $day)
    {
        $data = [];
        
        foreach ($student->subjects as $subject) {
            if ($subject->pivot->subject_id == $subjectId && $subject->pivot->created_at->format('Y-m-d') == $day) {
                array_push($data, $subject);
            }
        }

        return $data;
    }
}
