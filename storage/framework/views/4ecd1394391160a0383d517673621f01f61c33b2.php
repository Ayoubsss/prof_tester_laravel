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
                                <h3>Teacher Class List</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                           <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="card" style="margin-left:2em;width:10em;">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo e($class->name); ?></h5>
                              <h6 class="card-subtitle mb-2 text-muted"><?php echo e($class->subject); ?></h6>
                              <p class="card-text"><?php echo e($class->greeting); ?></p>
                              <button onclick="window.location = '../class/<?php echo e($class->id); ?>/edit';" class="btn btn-outline-dark btn-block" style="margin-bottom:3px;">Manage</button>
                            <?php echo Form::open(['action' => ['ClassController@destroy', $class->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']); ?>

                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                <?php echo e(Form::submit('Drop', ['class' => 'btn btn-outline-danger btn-block'])); ?>

                            
                            <?php echo Form::close(); ?>

                            </div>
                           </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <div class="card" style="margin-left:2em;width:10em;">
                                <div class="card-body">
                             
                                  <button onclick="window.location = '../class/create';" class="btn btn-outline-primary btn-block" style="margin-top:15px;">Add Class</button>
                                  
                                </div>
                            </div>
                        </div>
                       
                       
                    </div>
                <?php endif; ?>

              
            </div>
        </div>
    </div>
</div>

<script>

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