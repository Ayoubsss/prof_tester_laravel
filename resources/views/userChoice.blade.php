@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @auth
                    <div class="well py-4">
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <p>Greetings, <strong>{{ $name }}</strong></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <p>What type of user would you like to be:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <a href="{{ route('makeTeacher')}}" class="btn btn-outline-primary" role="button">I want to be a Teacher</a>
                                <a href="{{ route('makeStudent')}}" class="btn btn-outline-primary" role="button">I want to be a Student</a>
                            </div>
                        </div>
                    </div>
                @endauth

              
            </div>
        </div>
    </div>
</div>
@endsection
