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
                                <h3>Editing Quiz - <?php echo e($quiz->name); ?></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => ['QuizController@update', $quiz->id], 'method' => 'POST']); ?>

                                
                                        <div class="form-group">
                                            <?php echo e(Form::label('Name', 'Name')); ?>

                                            <?php echo e(Form::text('name', $quiz->name, ['class' => 'form-control', 'placeholder' => 'Enter your quiz name'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Description', 'Description')); ?>

                                            <?php echo e(Form::text('description', $quiz->description, ['class' => 'form-control', 'placeholder' => 'Enter your quiz description'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Weight', 'Weight')); ?>

                                            <input type="number" class="form-control" name="weight" maxlength="4" value="<?php echo e($quiz->weight); ?>" min="1" max="100">
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Is this a Group Quiz', 'Group Quiz')); ?>

                                            <?php echo e(Form::select('isGroupQuiz', array('1' => 'Yes', '0' => 'No') , $quiz->isGroupQuiz, array('class' => 'form-control'))); ?>

                                        </div>
                                        
                                        <div class="form-group">
                                            <?php echo e(Form::label('Quiz Answer Key', 'Answer Key')); ?>

                                            <?php echo e(Form::textarea('answerKey', $quiz->answerKey, ['class' => 'form-control', 'placeholder' => 'JSON answer key (focus on mobile functionality)'])); ?>

    
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Start Date', 'Start Date')); ?>

                                            <?php echo e(Form::date('startDate', $quiz->startDate)); ?> 
                                            
                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Expiration Date', 'Expiration Date')); ?>

                                            <?php echo e(Form::date('endDate', $quiz->endDate)); ?>  
                                        </div>
                                        <?php echo e(Form::hidden('_method', 'PUT')); ?>

                                            
                                        <?php echo e(Form::submit('Update Quiz', ['class' => 'btn btn-default btn-block'])); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                       
                    </div>
                    
                <?php endif; ?>

              
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>