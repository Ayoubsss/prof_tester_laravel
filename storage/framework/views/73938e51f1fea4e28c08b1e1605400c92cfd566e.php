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
                                <h3>Viewing Class - <strong><?php echo e($class->name); ?></strong></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <p><i><strong>Greetings.</strong> <?php echo e($class->greeting); ?></i></p>
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
                                <?php if(count($activeQuizzes) == 0): ?>
                                <p> No quizzes currently active or due</p>
                                <?php else: ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Due Before</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $activeQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <?php 
                                                        $date_expire_quiz = \Carbon\Carbon::parse($quiz->endDate);
                                                    ?>
                                                    <td><?php echo e($quiz->name); ?></td>
                                                    <td><?php echo e($date_expire_quiz->format('m / d / Y')); ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            
                                                            <?php if($date_expire_quiz->isPast()): ?>
                                                                <button class="btn btn-outline" disabled>Past Due</button>
                                                            <?php else: ?>    
                                                                <button onclick="window.location = '<?php echo e(route('takeQuiz',  $quiz->id)); ?>';" class="btn btn-outline-primary">Start Quiz</button>
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



                    </div>
                <?php endif; ?>

              
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('student.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>