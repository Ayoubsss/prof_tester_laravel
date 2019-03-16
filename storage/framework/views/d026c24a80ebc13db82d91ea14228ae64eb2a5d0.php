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
                                <h3>Teacher Classes</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                            <button onclick="window.location = '<?php echo e(route("class.create")); ?>';" class="btn btn-outline-dark btn-block">Create Class</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto; margin-top: 1em;">
                            <button onclick="window.location = '<?php echo e(route("list_classes")); ?>';" class="btn btn-outline-dark btn-block">List My Classes</button>
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