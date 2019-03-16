<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use App\Student;

class UserController extends Controller
{

    public function makeTeacher(){
        $teacher = new Teacher;
        
        $teacher->name = auth()->user()->name;
        $teacher->dob = '1992-02-18 06:00:00';
        $teacher->phone = '';
        $teacher->mobile = '';
        $teacher->status = 1;
        $teacher->user_id = auth()->user()->id;


        $teacher->save();

        //auth()->user()


        return redirect('/');
    }

    public function makeStudent(){
        $student = new Student;
        
        $student->name = auth()->user()->name;
        $student->dob = '1992-02-18 06:00:00';
        $student->phone = '';
        $student->mobile = '';
        $student->status = 1;
        $student->user_id = auth()->user()->id;


        $student->save();

        return redirect('/');
    }

    public function updateTeacher(Request $request){
        $currentUser = auth()->user();

        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'required'
        ]);

        $teacher = Teacher::find($currentUser->getTeacher->id);
        $teacher->name = $request->input('name');
        $teacher->dob = $request->input('dob');
        $teacher->phone = $request->input('phone');

        $teacher->save();

        return redirect('/')->with('success', 'Teacher Info. Updated');

    }

    public function updateStudent(Request $request){
        $currentUser = auth()->user();

        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'phone' => 'required'
        ]);

        $student = Student::find($currentUser->getStudent->id);
        $student->name = $request->input('name');
        $student->dob = $request->input('dob');
        $student->phone = $request->input('phone');

        $student->save();

        return redirect('/')->with('success', 'Student Info. Updated');

    }
}
