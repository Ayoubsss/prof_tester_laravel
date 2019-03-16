<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizAttempts;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        return view("teacher.quizzes.addQuiz")->with("classes_id", $request->input('classes_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'answerKey' => 'required',
            'isGroupQuiz' => 'required',
            'startDate' => 'required',
            'endDate' => 'required'
        ]);

        $classes_id = $request->input('classes_id');

        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->weight = $request->input('weight');
        $quiz->answerKey = $request->input('answerKey');
        $quiz->status = 1;
        $quiz->isGroupQuiz = $request->input('isGroupQuiz');
        $quiz->startDate = $request->input('startDate');
        $quiz->endDate = $request->input('endDate');
        $quiz->classes_id = $classes_id;

        $quiz->save();

        return redirect('/class/'.$classes_id.'/edit')->with('success', 'Quiz Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function takeQuiz($id)
    {
        $quiz = Quiz::find($id);
        // Implement logic to check whether the student can or cannot take the quiz
        // For API, use php artisan make:policy QuizPolicy --model=Quiz
        // Create policies for all other models

        return view("student.classes.takeQuiz")->with("keys", $quiz->answerKey)->with("quiz_id", $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);

        return view("teacher.quizzes.editQuiz")->with("quiz", $quiz);

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
            'description' => 'required',
            'weight' => 'required',
            'answerKey' => 'required',
            'isGroupQuiz' => 'required',
            'startDate' => 'required',
            'endDate' => 'required'
        ]);

        $quiz = Quiz::find($id);
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->weight = $request->input('weight');
        $quiz->answerKey = $request->input('answerKey');
        $quiz->status = 1;
        $quiz->isGroupQuiz = $request->input('isGroupQuiz');
        $quiz->startDate = $request->input('startDate');
        $quiz->endDate = $request->input('endDate');

        $quiz->save();
        
        return redirect('/class/'.$quiz->classes_id.'/edit')->with('success', 'Quiz Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        $quiz->delete();
        
        return redirect('/class/'.$quiz->classes_id.'/edit')->with('error', 'Quiz Deleted');
    }


    public function saveAttempt(Request $request){
        $student_id = auth()->user()->getStudent->id;

        $quiz = new QuizAttempts;
        $quiz->quiz_id = $request->quiz_id;
        $quiz->student_id = $student_id;
        $quiz->calculated_grade = $request->quiz_score;
        $quiz->attempt_date = \Carbon\Carbon::now()->toDateTimeString();

        $quiz->save();

        $response = array(
            'status' => 'success',
            'msg' => 'Your attempt has been saved',
        );
        return response()->json($response); 

        //return redirect('/class/'.$quiz->classes_id.'/edit')->with('error', 'Quiz Deleted');
    }
}
