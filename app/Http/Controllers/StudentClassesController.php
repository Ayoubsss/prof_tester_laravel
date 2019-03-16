<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes;
use App\StudentJoinReq;

class StudentClassesController extends Controller
{
     // Creates a Join class request
     public function joinClass($id){
        
        $student_id = auth()->user()->getStudent->id;

        //DB::insert('insert into student_join_req (student_id, classes_id) values (?, ?)', [$studentId, $id]);

        $request = StudentJoinReq::firstOrNew(array('student_id' => $student_id, 'classes_id' => $id));
        $request->save();

        // Database logic
        return redirect()->route('list_classes')->with('success', 'Join Request Sent');
    }
        
        
    // Deletes a Join class request
    public function dropStudent($class_id, $student_id){

        if($student_id == -1){
            $student_id = auth()->user()->getStudent->id;
        }

        DB::delete('delete from student_join_reqs where student_id = ? and classes_id = ?', [$student_id, $class_id]);

        // Database logic
        return redirect()->route('list_classes')->with('error', 'Join Request Cancelled');
    }

    public function searchForClass(Request $request){
        
        $this->validate($request, [
            'class_code' => 'required'
        ]);

        $class_code = $request->input('class_code');


        $searchedClass = Classes::where('code', $class_code)->first();

        return redirect()->route('list_classes')->with('searchedClass', $searchedClass);
    }

    public function approveRequest($id){
        
       
        $joinRequest = StudentJoinReq::find($id);

        $joinRequest->state = true;

        $joinRequest->save();

        return redirect()->route('list_classes')->with('success', 'Join Request Approved');
    }


}
