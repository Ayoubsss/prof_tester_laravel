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
                                <h3>Managing Class - <?php echo e($class->name); ?></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => ['ClassController@update', $class->id], 'method' => 'POST']); ?>

                                
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Name', 'Class Name')); ?>

                                            <?php echo e(Form::text('name', $class->name, ['class' => 'form-control', 'placeholder' => 'Enter your class name'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Subject', 'Class Subject')); ?>

                                            <?php echo e(Form::select('subject', $class_subjects, null, array('class' => 'form-control','id' => 'subjects'))); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Greeting', 'Class Greeting')); ?>

                                            <?php echo e(Form::text('greeting', $class->greeting, ['class' => 'form-control', 'placeholder' => 'Enter your class greeting'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Code', 'Class Code')); ?>

                                        </div>
                                        <div class="input-group mb-3">
                                            <?php echo e(Form::text('code', $class->code, ['class' => 'form-control', 'id' => 'code_input'])); ?>

                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary" type="button" onclick="generateCode()">Generate Code</button>
                                            </div>
                                        </div>
                                        <?php echo e(Form::hidden('_method', 'PUT')); ?>

                                        <?php echo e(Form::submit('Update Class Info', ['class' => 'btn btn-default btn-block'])); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Students</h3>
                                <?php if(count($requests) == 0): ?>
                                    <p>No students belong to this class</p>
                                <?php else: ?>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Student Name</th>
                                            <th scope="col" colspan="2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($student_request->name); ?></td>
                                                    <td> 
                                                        <div class="btn-group">

                                                            <?php if($student_request->pivot->state == 1): ?>
                                                                <?php echo Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => $student_request->id], 'method' => 'POST']); ?>

                                                                
                                                                    <?php echo e(Form::submit('Drop', ['class' => 'btn btn-outline-danger', 'style' => 'margin-right: 10px;'])); ?>


                                                                <?php echo Form::close(); ?>

                                                               

                                                            <?php elseif($student_request->pivot->state == 0): ?>
                                                                <?php echo Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => $student_request->id], 'method' => 'POST']); ?>

                                                                
                                                                    <?php echo e(Form::submit('Cancel Request', ['class' => 'btn btn-outline-danger', 'style' => 'margin-right: 10px;'])); ?>


                                                                <?php echo Form::close(); ?>

                                                                
                                                                <?php echo Form::open(['action' => ['StudentClassesController@approveRequest', 'request_id' => $student_request->pivot->id], 'method' => 'POST']); ?>

                                                                
                                                                    <?php echo e(Form::submit('Approve', ['class' => 'btn btn-outline-primary'])); ?>


                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Quizzes/Tests</h3>
                                <?php if(count($quizzes) == 0): ?>
                                <p>No quizzes are available for this class</p>
                                <?php else: ?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" colspan="2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($quiz->id); ?></th>
                                            <td><?php echo e($quiz->name); ?></td>
                                            <td><?php echo e($quiz->description); ?></td>
                                            <td><button onclick="window.location = '<?php echo e(route("quizzes.edit", $quiz->id)); ?>';" class='btn btn-default'>Edit</button></td>
                                            <td>
                                                <?php echo Form::open(['action' => ['QuizController@destroy', $quiz->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']); ?>

                                                    <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                    <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger'])); ?>

                                                <?php echo Form::close(); ?>

                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                                <?php endif; ?>
                                
                            <?php echo Form::open(['action' => ['QuizController@create'], 'method' => 'POST']); ?>

                                <?php echo e(Form::hidden('_method', 'GET')); ?>

                                <?php echo e(Form::hidden('classes_id', $class->id)); ?>

                                <?php echo e(Form::submit('Add New Quiz', ['class' => 'btn btn-primary btn-block'])); ?>

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

        function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

       
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>