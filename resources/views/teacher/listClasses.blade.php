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
                                <h3>Teacher Class List</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                           @foreach($classes as $class)
                           <div class="card" style="margin-left:2em;width:10em;">
                            <div class="card-body">
                              <h5 class="card-title">{{$class->name}}</h5>
                              <h6 class="card-subtitle mb-2 text-muted">{{$class->subject}}</h6>
                              <p class="card-text">{{$class->greeting}}</p>
                              <button onclick="window.location = '../class/{{$class->id}}/edit';" class="btn btn-outline-dark btn-block" style="margin-bottom:3px;">Manage</button>
                            {!! Form::open(['action' => ['ClassController@destroy', $class->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Drop', ['class' => 'btn btn-outline-danger btn-block'])}}
                            
                            {!! Form::close() !!}
                            </div>
                           </div>
                           @endforeach
                           <div class="card" style="margin-left:2em;width:10em;">
                                <div class="card-body">
                             
                                  <button onclick="window.location = '../class/create';" class="btn btn-outline-primary btn-block" style="margin-top:15px;">Add Class</button>
                                  
                                </div>
                            </div>
                        </div>
                       
                       
                    </div>
                @endauth

              
            </div>
        </div>
    </div>
</div>

<script>

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
