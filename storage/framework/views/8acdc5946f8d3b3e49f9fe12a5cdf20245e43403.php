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
                                <h3>Join Class</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => 'StudentClassesController@searchForClass', 'method' => 'POST']); ?>

                                    <?php echo e(Form::label('Input Class Code', 'Input Class Code')); ?>

                                    <div class="input-group mb-3">
                                        <?php echo e(Form::text('class_code', '', ['class' => 'form-control'])); ?>

                                        <div class="input-group-append">
                                            <?php echo e(Form::submit('Search for Class', ['class' => 'btn btn-outline-secondary'])); ?>

                                        </div>
                                    </div>
                                
                                <?php echo Form::close(); ?>


                                

                                <?php if( session('searchedClass') ): ?>
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
                                                <td><?php echo e(session('searchedClass')->name); ?></td>
                                                <td><?php echo e(session('searchedClass')->subject); ?></td>
                                                <td>
                                                    <?php echo Form::open(['action' => ['StudentClassesController@joinClass', session('searchedClass')->id], 'method' => 'POST']); ?>

                                                        <?php echo e(Form::submit('Join', ['class' => 'btn btn-primary'])); ?>

                                                    <?php echo Form::close(); ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                <?php endif; ?>
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
                                    <?php if( count($classJoinRequests) > 0 ): ?>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $classJoinRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($class->name); ?></td>
                                                    <td><?php echo e($class->subject); ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if($class->pivot->state == 0): ?>
                                                                <?php echo Form::open(['action' => ['StudentClassesController@dropStudent', 'class_id' => $class->id, 'student_id' => -1 ], 'method' => 'POST']); ?>

                                                                    
                                                                    
                                                                    <?php echo e(Form::submit('Cancel Request', ['class' => 'btn btn-outline-danger'])); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php elseif($class->pivot->state == 1): ?>     
                                                        <button onclick="window.location = '<?php echo e(route('viewClass', $class->id)); ?>';" class="btn btn-outline-primary">View</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                <?php else: ?>
                                    No classes joined
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        
                       
                    </div>
                <?php endif; ?>

              
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('student.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>