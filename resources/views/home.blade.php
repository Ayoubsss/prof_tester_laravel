@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @guest
                    <div class="well py-4">You need to login or register</div>
                @endguest

              
            </div>
        </div>
    </div>
</div>
@endsection
