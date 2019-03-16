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
                                <h3>Create a new Class</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => 'ClassController@store', 'method' => 'POST']) !!}
                                
                                        <div class="form-group">
                                            {{Form::label('Class Name', 'Class Name')}}
                                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter your class name'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Subject', 'Class Subject')}}
                                            {{Form::select('subject', $class_subjects, null, array('class' => 'form-control','id' => 'subjects'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Greeting', 'Class Greeting')}}
                                            {{Form::text('greeting', '', ['class' => 'form-control', 'placeholder' => 'Enter your class greeting'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Class Code', 'Class Code')}}
                                        </div>
                                        <div class="input-group mb-3">
                                            {{Form::text('code', '', ['class' => 'form-control', 'id' => 'code_input'])}}
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary" type="button" onclick="generateCode()">Generate Code</button>
                                            </div>
                                        </div>
                                            
                                        {{Form::submit('Create New Class', ['class' => 'btn btn-primary btn-block'])}}
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
