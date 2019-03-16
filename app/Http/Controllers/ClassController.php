<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\User;
use App\ClassSubject;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Use pluck to populate Form::select in view
        $class_subjects = ClassSubject::pluck('name', 'name');
        
 
        return view("teacher.newClass")->with("class_subjects", $class_subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Only teachers can create classes
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'greeting' => 'required',
            'subject' => 'required'
        ]);

        $class = new Classes;
        $class->name = $request->input('name');
        $class->code = $request->input('code');
        $class->greeting = $request->input('greeting');
        $class->subject = $request->input('subject');
        $class->teacher_id = auth()->user()->getTeacher->id;

        $class->save();

        return redirect()->route('list_classes')->with('success', 'Class Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Classes::find($id);
        $activeQuizzes = $class->activeQuizzes;

        return view("student.classes.view")->with(array(
            "class" => $class,
            "activeQuizzes" => $activeQuizzes
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classes::find($id);
        $quizzes = $class->quizzes;
        $class_subjects = ClassSubject::pluck('name', 'name');
        $joinRequests = $class->studentsRequests;

        return view('teacher.manageClass')->with(array(
            "class" => $class, 
            "class_subjects" => $class_subjects,
            "quizzes" => $quizzes,
            "requests" => $joinRequests
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'greeting' => 'required',
            'subject' => 'required'
        ]);

        $class = Classes::find($id);
        $class->name = $request->input('name');
        $class->code = $request->input('code');
        $class->greeting = $request->input('greeting');
        $class->subject = $request->input('subject');

        $class->save();

        return redirect('/classes')->with('success', 'Class Updated');
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Classes::find($id)->delete();

        return redirect('/classes/list')->with('error', 'Class Deleted');
    }
}
