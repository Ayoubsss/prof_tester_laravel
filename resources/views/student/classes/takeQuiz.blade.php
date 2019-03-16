@extends('student.layout')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">

            @auth

                <div class="well py-4">
                    <div class="row" id="keyContainer" align="center">
                        <div class="col-md-12" id="buttonContainer">
                            <button class="btn btn-outline-success btn-block" onclick="startQuiz()">Start Quiz</button>
                        </div>

                        <p id="counter"></p>
                        <!--
                        <div class="col-md-2 answerKey">
                            <img src="{{ asset("images/answerKeys/hiddenA.png")}}" alt="Key A" />
                        </div>
                        <div class="col-md-2 answerKey">
                            <img src="{{ asset("images/answerKeys/hiddenB.png")}}" alt="Key B" />
                        </div>
                        <div class="col-md-2 answerKey">
                            <img src="{{ asset("images/answerKeys/hiddenC.png")}}" alt="Key C" />
                            </div>
                        <div class="col-md-2 answerKey">
                            <img src="{{ asset("images/answerKeys/hiddenD.png")}}" alt="Key D" />
                        </div>
                    -->
                    </div>
                    <input type="hidden" value="{{ $quiz_id }}" id="quiz_id" />
                    <input type="hidden" value="{{ $keys }}" id="numQuestions" />
                    <input type="hidden" value="{{ asset("images/answerKeys/hiddenA.png") }}"  id="key_A_path" />


                </div>
            @endauth
        </div>
    </div>
</div>

<style type="text">
    .answerKey img{
        border: 1px solid grey !important;
    }
</style>

<script>

    $("#wrapper").toggleClass("toggled");

    var countdown = 3;
    var counter = 0;
    var quizLength,keys;
    var score = 0;
    var right = false;


    var Key_A = $("<div class='col-md-2 answerKey' style='cursor:pointer;'><img src='" + $("#key_A_path").val().replace("hiddenA", "hiddenA") + "' alt='Key A'/></div>");
    var Key_B = $("<div class='col-md-2 answerKey' style='cursor:pointer;'><img src='" + $("#key_A_path").val().replace("hiddenA", "hiddenB") + "' alt='Key B'/></div>");
    var Key_C = $("<div class='col-md-2 answerKey' style='cursor:pointer;'><img src='" + $("#key_A_path").val().replace("hiddenA", "hiddenC") + "' alt='Key C'/></div>");
    var Key_D = $("<div class='col-md-2 answerKey' style='cursor:pointer;'><img src='" + $("#key_A_path").val().replace("hiddenA", "hiddenD") + "' alt='Key D'/></div>");
    var CSRF_TOKEN;



    $(document).ready(function(){

        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        keys = $("#numQuestions").val().split(".");
        quizLength = keys.length / 2;
        score = quizLength*4 ;


        Key_A.dblclick(function(){
            if(validateAnswer("A")){
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "revealA") );
                right = true;
                setTimeout("nextQuestion()", 1000);
                
            }else{
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "wrongA") );
                score--;
                right = false;
            }
        });

        
        Key_B.dblclick(function(){
            if(validateAnswer("B")){
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "revealB") );
                right = true;
                setTimeout("nextQuestion()", 1000);
            }else{
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "wrongB") );
                score--;
                right = false;
            }
        });


        Key_C.dblclick(function(){
            if(validateAnswer("C")){
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "revealC") );
                right = true;
                setTimeout("nextQuestion()", 1000);
            }else{
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "wrongC") );
                score--;
                right = false;
            }
        });


        Key_D.dblclick(function(){
            if(validateAnswer("D")){
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "revealD") );
                right = true;
                setTimeout("nextQuestion()", 1000);
            }else{
                $(this).find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "wrongD") );
                score--;
                right = false;
            }
        });
    });

    function startQuiz(){
        $("#buttonContainer").hide("fast", function(){
            $("#counter").show("fast");
            countDown();
        });
    }

    function validateAnswer(val){
        for(var i=0; i < keys.length; i++){
            //console.log(keys[i] + " " + counter);
            if(parseInt(keys[i])==counter){
                
                if(keys[i+1]==val){
                    
                    return true;
                }
            }
        } 
        return false;
    }

    function nextQuestion(){
        //alert(quizLength + " . " + counter);

        $("#keyContainer").hide("fast", function(){
            $(this).show("fast");
        });

        if(counter+1 == quizLength){
            $.ajax({
                /* the route pointing to the post function */
                url: 'http://localhost/prof_tester_laravel/public/student/quiz/submit',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {_token: CSRF_TOKEN, quiz_id: $("#quiz_id").val(), quiz_score: score},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) { 
                    alert(data.msg);
                }
            }); 
        }
      

        if(right==true){
            counter++;
            Key_A.find("img").attr( "src", $("#key_A_path").val() );
            Key_B.find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "hiddenB" ) );
            Key_C.find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "hiddenC" ) );
            Key_D.find("img").attr( "src", $("#key_A_path").val().replace("hiddenA", "hiddenD" ) );
        }

        
        
       
    }

    function countDown(){

        if(window.countdown>0)
            $("#counter").text(window.countdown);

        window.countdown--;
        

        if(window.countdown > -1) {
            setTimeout("countDown()", 1000);
        }else{
            $("#counter").hide("fast");
            $("#keyContainer").html("");
            $("#keyContainer").append(Key_A).append(Key_B).append(Key_C).append(Key_D);
            nextQuestion();
        }
            

    }

    


</script>

@endsection
