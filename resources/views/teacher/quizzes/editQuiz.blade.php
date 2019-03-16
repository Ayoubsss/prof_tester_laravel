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
                                <h3>Editing Quiz - {{ $quiz->name }}</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => ['QuizController@update', $quiz->id], 'method' => 'POST']) !!}
                                
                                        <div class="form-group">
                                            {{Form::label('Name', 'Name')}}
                                            {{Form::text('name', $quiz->name, ['class' => 'form-control', 'placeholder' => 'Enter your quiz name'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Description', 'Description')}}
                                            {{Form::text('description', $quiz->description, ['class' => 'form-control', 'placeholder' => 'Enter your quiz description'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Weight', 'Weight')}}
                                            <input type="number" class="form-control" name="weight" maxlength="4" value="{{$quiz->weight}}" min="1" max="100">
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Is this a Group Quiz', 'Group Quiz')}}
                                            {{Form::select('isGroupQuiz', array('1' => 'Yes', '0' => 'No') , $quiz->isGroupQuiz, array('class' => 'form-control'))}}
                                        </div>
                                        
                                        <div class="form-group">
                                            {{Form::label('Quiz Answer Key', 'Answer Key')}}
                                            {{Form::textarea('answerKey', $quiz->answerKey, ['class' => 'form-control', 'placeholder' => 'JSON answer key (focus on mobile functionality)'])}}
    
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Start Date', 'Start Date')}}
                                            {{ Form::date('startDate', $quiz->startDate) }} 
                                            
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Expiration Date', 'Expiration Date')}}
                                            {{ Form::date('endDate', $quiz->endDate) }}  
                                        </div>
                                        {{Form::hidden('_method', 'PUT')}}
                                            
                                        {{Form::submit('Update Quiz', ['class' => 'btn btn-default btn-block'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                       
                    </div>
                    
                @endauth

              
            </div>
        </div>
    </div>
</div>

@endsection
