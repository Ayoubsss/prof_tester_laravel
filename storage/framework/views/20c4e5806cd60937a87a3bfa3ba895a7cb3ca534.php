<?php $__env->startSection('content'); ?>
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
                <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="card">

                <?php if(auth()->guard()->check()): ?>
                    <div class="well py-4">
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Create a new Quiz</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => 'QuizController@store', 'method' => 'POST']); ?>

                                
                                        <div class="form-group">
                                            <?php echo e(Form::label('Name', 'Name')); ?>

                                            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter your quiz name'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Description', 'Description')); ?>

                                            <?php echo e(Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Enter your quiz description'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Weight', 'Weight')); ?>

                                            <input type="number" class="form-control" name="weight" maxlength="4" value="1" min="1" max="100">
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Is this a Group Quiz', 'Group Quiz')); ?>

                                            <?php echo e(Form::select('isGroupQuiz', array('1' => 'Yes', '0' => 'No') , 0, array('class' => 'form-control'))); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Quiz Answer Key', 'Answer Key')); ?>

                                            <?php echo e(Form::textarea('answerKey', '', ['class' => 'form-control', 'placeholder' => 'JSON answer key (focus on mobile functionality)'])); ?>

    
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Start Date', 'Start Date')); ?>

                                            <?php echo e(Form::date('startDate', null)); ?>  
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Expiration Date', 'Expiration Date')); ?>

                                            <?php echo e(Form::date('endDate', null)); ?>  
                                        </div>
                                        <?php echo e(Form::hidden('classes_id', $classes_id)); ?>

                                       
                                            
                                        <?php echo e(Form::submit('Create New Quiz', ['class' => 'btn btn-primary btn-block'])); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                       
                    </div>
                    
                <?php endif; ?>

              
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>