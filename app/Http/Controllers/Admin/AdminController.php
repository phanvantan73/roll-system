<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use App\User;
use Carbon\Carbon;
use File;
use Auth;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function getAll()
    {
        $requestDay = Carbon::now();
        $day = $requestDay->dayOfWeek;
        $requestDay = $requestDay->format('d-m-Y');
        $path = public_path('file/' . Carbon::now()->toDateString() . '.txt');
        $data = [];
        $errors = [];
        if (File::exists($path)) {
            $contents = File::get($path);
            $contents = explode(PHP_EOL, $contents);
            $subjectsInDay = Subject::where('learn_time', $day)->get();
            for ($i = 0; $i < count($contents) - 1; $i++) {
                $content = explode(',', $contents[$i]);
                $student = Student::getStudentFromMssv($content[0]);
                if ($student) {
                    $rollTime = $content[1];
                    $data[$i] = [
                        'student' => $student,
                        'rollTime' => $rollTime,
                    ];
                    foreach ($subjectsInDay as $key => $subject) {
                        $check = DB::table('student_subject')->where('student_id', $student->id)->where('subject_id', $subject->id)
                            ->where('created_at', Carbon::today()->toDateString() . ' ' . $rollTime)->get();
                        
                        if ($rollTime >= $subject->start_time && $rollTime <= $subject->end_time ) {
                            if (!count($check)) {
                                $student->subjects()->attach($subject->id, [
                                    'created_at' => Carbon::today()->toDateString() . ' ' . $rollTime,
                                    'status' => 1,
                                ]);
                            }
                        }
                    }
                }
            }
        } else {
            $errors['error'] = 'Camera chưa cập nhật kết quả!';
        }
        
        
        return view('sumary', compact('requestDay', 'data', 'errors'));

    }

    public function addStudent(Request $request)
    {
        $name = $request->name;
        $mssv = $request->mssv;
        $user = User::create([
            'name' => $name,
            'email' => $mssv . '@sv.com.vn',
            'password' => bcrypt('12345678'),
        ]);

        $student = $user->student()->create([
            'name' => $name,
            'mssv' => $mssv,
            'class' => '13T1',
        ]);
        $user = $user->load('student');

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public function getAllStudent(Request $request)
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('admin.student', compact('users'));
    }
}
