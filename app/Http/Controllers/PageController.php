<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Teacher;
use App\Student;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()){
           
            auth()->user()->updateType();

            switch(auth()->user()->type)
            {
                case 0:
                    return view("userChoice")->with("name", auth()->user()->name);
                    break;

                case 1:
                    $student = auth()->user()->getStudent;
                    return view("student.profile")->with('studentInfo', $student);
                    break;

                case 2:
                    $teacher = auth()->user()->getTeacher;
                    return view("teacher.profile")->with('teacherInfo', $teacher);
                    break;
            }
            
        }

        return view('home');
    }

   

    public function list_classes(){
    
        auth()->user()->updateType();
    
        switch(auth()->user()->type)
        {
            // 1 is for students
            case 1:
                $classJoinRequests = auth()->user()->getStudent->classJoinRequests;
                return view("student.classes")->with('classJoinRequests', $classJoinRequests);
                break;

            case 2:
                $classes = auth()->user()->getTeacher->classes;
                return view("teacher.listClasses")->with('classes', $classes);
                break;
        }

        
    }
}
