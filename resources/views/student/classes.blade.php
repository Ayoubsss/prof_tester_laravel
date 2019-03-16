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
                                <h3>Join Class</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                {!! Form::open(['action' => 'StudentClassesController@searchForClass', 'method' => 'POST']) !!}
                                    {{Form::label('Input Class Code', 'Input Class Code')}}
                                    <div class="input-group mb-3">
                                        {{Form::text('class_code', '', ['class' => 'form-control'])}}
                                        <div class="input-group-append">
                                            {{Form::submit('Search for Class', ['class' => 'btn btn-outline-secondary'])}}
                                        </div>
                                    </div>
                                
                                {!! Form::close() !!}

                                

                                @if( session('searchedClass') )
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{session('searchedClass')->name}}</td>
                                                <td>{{session('searchedClass')->subject}}</td>
                                                <td>
                                                    {!! Form::open(['action' => ['StudentClassesController@joinClass', session('searchedClass')->id], 'method' => 'POST']) !!}
                                                        {{Form::submit('Join', ['class' => 'btn btn-primary'])}}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>My Classes</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                    @if( count($classJoinRequests) > 0 )
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classJoinRequests as $class)
                                                <tr>
                                                    <td>{{$class->name}}</td>
                                                    <td>{{$class->subject}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            @if($class->pivot->state == 0)
                                                                {!! Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => -1 ], 'method' => 'POST']) !!}
                                                                    
                                                                    
                                                                    {{Form::submit('Cancel Request', ['class' => 'btn btn-outline-danger'])}}
                                                                {!! Form::close() !!}
                                                            @elseif($class->pivot->state == 1)     
                                                        <button onclick="window.location = '{{ route('viewClass', $class->id) }}';" class="btn btn-outline-primary">View</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    No classes joined
                                @endif
                            </div>
                        </div>
                        
                        
                       
                    </div>
                @endauth

              
            </div>
        </div>
    </div>
</div>
@endsection
