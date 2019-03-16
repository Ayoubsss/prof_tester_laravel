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
                                <h3>Create a new Quiz</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => 'QuizController@store', 'method' => 'POST']) !!}
                                
                                        <div class="form-group">
                                            {{Form::label('Name', 'Name')}}
                                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter your quiz name'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Description', 'Description')}}
                                            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Enter your quiz description'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Weight', 'Weight')}}
                                            <input type="number" class="form-control" name="weight" maxlength="4" value="1" min="1" max="100">
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Is this a Group Quiz', 'Group Quiz')}}
                                            {{Form::select('isGroupQuiz', array('1' => 'Yes', '0' => 'No') , 0, array('class' => 'form-control'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Quiz Answer Key', 'Answer Key')}}
                                            {{Form::textarea('answerKey', '', ['class' => 'form-control', 'placeholder' => 'JSON answer key (focus on mobile functionality)'])}}
    
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Start Date', 'Start Date')}}
                                            {{ Form::date('startDate', null) }}  
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Expiration Date', 'Expiration Date')}}
                                            {{ Form::date('endDate', null) }}  
                                        </div>
                                        {{ Form::hidden('classes_id', $classes_id) }}
                                       
                                            
                                        {{Form::submit('Create New Quiz', ['class' => 'btn btn-primary btn-block'])}}
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

        $(document).ready(function(){
            generateCode();
        });
</script>
@endsection
