@extends('student.layout')

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
                                <h3>Student Profile</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => ['UserController@updateStudent'], 'method' => 'POST']) !!}
                                
                                        <div class="form-group">
                                            {{Form::label('name', 'Name')}}
                                            {{Form::text('name', $studentInfo->name, ['class' => 'form-control', 'placeholder' => 'Type the Full Name'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('dob', 'Date of Birth')}}
                                            {{Form::text('dob', $studentInfo->dob, ['class' => 'form-control', 'placeholder' => 'Select a date of birth'])}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('phone', 'Phone')}}
                                            {{Form::text('phone', $studentInfo->phone, ['class' => 'form-control', 'placeholder' => 'Type your phone number'])}}
                                        </div>
                                        {{Form::hidden('_method', 'PUT')}}
                                        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
                                
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
