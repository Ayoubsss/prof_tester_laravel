<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <?php if(auth()->guard()->check()): ?>
                    <div class="well py-4">
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <h3>Teacher Dashboard</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => ['UserController@updateTeacher'], 'method' => 'POST']); ?>

                                
                                        <div class="form-group">
                                            <?php echo e(Form::label('name', 'Name')); ?>

                                            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Type the Full Name'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('dob', 'Date of Birth')); ?>

                                            <?php echo e(Form::text('dob', '', ['class' => 'form-control', 'placeholder' => 'Select a date of birth'])); ?>

                                        </div>
                                        <?php echo e(Form::hidden('_method', 'PUT')); ?>

                                        <?php echo e(Form::submit('Update', ['class' => 'btn btn-primary'])); ?>

                                
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