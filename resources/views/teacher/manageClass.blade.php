@extends('teacher.layout')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('inc.messages')
            <div class="card">

                @auth
                    <div class="well py-4">
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Managing Class - {{$class->name}}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => ['ClassController@update', $class->id], 'method' => 'POST']) !!}
                                
                                        <div class="form-group">
                                            {{Form::label('Class Name', 'Class Name')}}
                                            {{Form::text('name', $class->name, ['class' => 'form-control', 'placeholder' => 'Enter your class name'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Subject', 'Class Subject')}}
                                            {{Form::select('subject', $class_subjects, null, array('class' => 'form-control','id' => 'subjects'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Greeting', 'Class Greeting')}}
                                            {{Form::text('greeting', $class->greeting, ['class' => 'form-control', 'placeholder' => 'Enter your class greeting'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Code', 'Class Code')}}
                                        </div>
                                        <div class="input-group mb-3">
                                            {{Form::text('code', $class->code, ['class' => 'form-control', 'id' => 'code_input'])}}
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary" type="button" onclick="generateCode()">Generate Code</button>
                                            </div>
                                        </div>
                                        {{Form::hidden('_method', 'PUT')}}
                                        {{Form::submit('Update Class Info', ['class' => 'btn btn-default btn-block'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Students</h3>
                                @if(count($requests) == 0)
                                    <p>No students belong to this class</p>
                                @else
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Student Name</th>
                                            <th scope="col" colspan="2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $student_request)
                                                <tr>
                                                    <td>{{$student_request->name}}</td>
                                                    <td> 
                                                        <div class="btn-group">

                                                            @if($student_request->pivot->state == 1)
                                                                {!! Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => $student_request->id], 'method' => 'POST']) !!}
                                                                
                                                                    {{Form::submit('Drop', ['class' => 'btn btn-outline-danger', 'style' => 'margin-right: 10px;'])}}

                                                                {!! Form::close() !!}
                                                               

                                                            @elseif($student_request->pivot->state == 0)
                                                                {!! Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => $student_request->id], 'method' => 'POST']) !!}
                                                                
                                                                    {{Form::submit('Cancel Request', ['class' => 'btn btn-outline-danger', 'style' => 'margin-right: 10px;'])}}

                                                                {!! Form::close() !!}
                                                                
                                                                {!! Form::open(['action' => ['StudentClassesController@approveRequest', 'request_id' => $student_request->pivot->id], 'method' => 'POST']) !!}
                                                                
                                                                    {{Form::submit('Approve', ['class' => 'btn btn-outline-primary'])}}

                                                                {!! Form::close() !!}
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Quizzes/Tests</h3>
                                @if(count($quizzes) == 0)
                                <p>No quizzes are available for this class</p>
                                @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" colspan="2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quizzes as $quiz)
                                        <tr>
                                            <th scope="row">{{$quiz->id}}</th>
                                            <td>{{$quiz->name}}</td>
                                            <td>{{$quiz->description}}</td>
                                            <td><button onclick="window.location = '{{ route("quizzes.edit", $quiz->id) }}';" class='btn btn-default'>Edit</button></td>
                                            <td>
                                                {!! Form::open(['action' => ['QuizController@destroy', $quiz->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @endif
                                
                            {!! Form::open(['action' => ['QuizController@create'], 'method' => 'POST']) !!}
                                {{Form::hidden('_method', 'GET')}}
                                {{Form::hidden('classes_id', $class->id)}}
                                {{Form::submit('Add New Quiz', ['class' => 'btn btn-primary btn-block'])}}
                            {!! Form::close() !!}
                            </div>
                        </div>
                        
                        
                       
                    </div>
                    
                @endauth

              
            </div>
        </div>
    </div>
</div>

<script>
        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789&%$_";
        
            for( var i=0; i < 4; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));
        
            return text;
        }
        
        function generateCode()
        {
            var selectedText = $("#subjects option:selected").text();
            $("#code_input").val(selectedText[0]+"0" + makeid());
        }

        function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

       
</script>
@endsection
