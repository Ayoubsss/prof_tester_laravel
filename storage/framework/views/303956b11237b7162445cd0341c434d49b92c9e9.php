<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Professor Tester v1.5')); ?> - Teacher View</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/simple-sidebar.css')); ?>" rel="stylesheet">
</head>
<body>
        <div id="wrapper">
                
                        <!-- Sidebar need to rememeber that this need pop in the side it looks 
                        better-->
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <li class="sidebar-brand">
                                    <a href="#">
                                        <?php echo e(config('app.name', 'Professor Tester v1.5')); ?> <!--im ging to need a logo like a pic -->
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('profile')); ?>">
                                        Teacher Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('list_classes')); ?>">
                                        Classes
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         <?php echo e(__('Logout')); ?>

                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>                
    <div id="app">
   
        
        <main class="py-4">
            
            <?php echo $__env->yieldContent('content'); ?>
            
        </main>

        
        
    </div>

    <script>

    $("#wrapper").toggleClass("toggled");

    </script>

   
</body>
</html>
