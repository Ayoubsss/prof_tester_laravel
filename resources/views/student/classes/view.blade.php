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
                                <h3>Viewing Class - <strong>{{$class->name}}</strong></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <p><i><strong>Greetings.</strong> {{$class->greeting}}</i></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Quizzes</h3>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto; margin-top:10px;">
                                @if(count($activeQuizzes) == 0)
                                <p> No quizzes currently active or due</p>
                                @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Due Before</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activeQuizzes as $quiz)
                                                <tr>
                                                    <?php 
                                                        $date_expire_quiz = \Carbon\Carbon::parse($quiz->endDate);
                                                    ?>
                                                    <td>{{$quiz->name}}</td>
                                                    <td>{{$date_expire_quiz->format('m / d / Y')}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            
                                                            @if($date_expire_quiz->isPast())
                                                                <button class="btn btn-outline" disabled>Past Due</button>
                                                            @else    
                                                                <button onclick="window.location = '{{ route('takeQuiz',  $quiz->id) }}';" class="btn btn-outline-primary">Start Quiz</button>
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



                    </div>
                @endauth

              
            </div>
        </div>
    </div>
</div>
@endsection
