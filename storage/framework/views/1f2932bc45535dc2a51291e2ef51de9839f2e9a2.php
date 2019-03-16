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
                                <h3>Create a new Class</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10" style="float: none; margin: 0 auto;">
                                <?php echo Form::open(['action' => 'ClassController@store', 'method' => 'POST']); ?>

                                
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Name', 'Class Name')); ?>

                                            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter your class name'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Subject', 'Class Subject')); ?>

                                            <?php echo e(Form::select('subject', $class_subjects, null, array('class' => 'form-control','id' => 'subjects'))); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Greeting', 'Class Greeting')); ?>

                                            <?php echo e(Form::text('greeting', '', ['class' => 'form-control', 'placeholder' => 'Enter your class greeting'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::label('Class Code', 'Class Code')); ?>

                                        </div>
                                        <div class="input-group mb-3">
                                            <?php echo e(Form::text('code', '', ['class' => 'form-control', 'id' => 'code_input'])); ?>

                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary" type="button" onclick="generateCode()">Generate Code</button>
                                            </div>
                                        </div>
                                            
                                        <?php echo e(Form::submit('Create New Class', ['class' => 'btn btn-primary btn-block'])); ?>

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