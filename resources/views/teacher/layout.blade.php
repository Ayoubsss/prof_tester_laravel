<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Professor Tester v1.5') }} - Teacher View</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
</head>
<body>
        <div id="wrapper">
                
                        <!-- Sidebar need to rememeber that this need pop in the side it looks 
                        better-->
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <li class="sidebar-brand">
                                    <a href="#">
                                        {{ config('app.name', 'Professor Tester v1.5') }} <!--im ging to need a logo like a pic -->
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile') }}">
                                        Teacher Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('list_classes') }}">
                                        Classes
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>                
    <div id="app">
   
        
        <main class="py-4">
            
            @yield('content')
            
        </main>

        
        
    </div>

    <script>

    $("#wrapper").toggleClass("toggled");

    </script>

   
</body>
</html>
