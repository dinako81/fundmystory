<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/front/sass/app.scss', 'resources/front/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="nav-item mt-4" style="font-size: 30px">
                        <a class="nav-link " href="{{ route('stories-index') }}">
                            Stories list
                        </a>
                    </ul>
                    <ul class="nav-item mt-4" style="font-size: 30px">
                        <a class="nav-link " href="{{ route('stories-create') }}">
                            New Story
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front-orders') }}">My stories</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>


                        @endguest



                        <li class="nav-item">
                            <div class="top-cart --top--cart" data-url="{{route('cart-mini-cart')}}">
                                <a href="{{route('cart-show')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
                                        <g>
                                            <g>
                                                <path d="M422.957,133.565H372.87V116.87C372.87,52.428,320.442,0,256,0S139.13,52.428,139.13,116.87v16.696H89.044
			c-9.22,0-16.696,7.475-16.696,16.696v311.652c0,27.618,22.469,50.087,50.087,50.087h267.13c27.618,0,50.087-22.469,50.087-50.087
			V150.261C439.652,141.04,432.177,133.565,422.957,133.565z M172.522,116.87c0-46.03,37.448-83.478,83.478-83.478
			s83.478,37.448,83.478,83.478v16.696H172.522V116.87z M406.261,461.913c0,9.206-7.49,16.696-16.696,16.696h-267.13
			c-9.206,0-16.696-7.49-16.696-16.696V350.609h33.391V384c0,9.22,7.475,16.696,16.696,16.696
			c43.538,0,80.076-12.261,100.174-31.382c20.098,19.121,56.636,31.382,100.174,31.382c9.22,0,16.696-7.475,16.696-16.696v-33.391
			h33.391V461.913z M172.522,366.571v-65.316c41.256,3.698,66.783,20.596,66.783,32.658
			C239.304,345.975,213.778,362.873,172.522,366.571z M272.696,333.913c0-12.062,25.526-28.96,66.783-32.658v65.316
			C298.222,362.873,272.696,345.975,272.696,333.913z M406.261,317.217H372.87v-33.391c0-9.22-7.475-16.696-16.696-16.696
			c-43.538,0-80.076,12.261-100.174,31.382c-20.098-19.121-56.636-31.382-100.174-31.382c-9.22,0-16.696,7.475-16.696,16.696v33.391
			h-33.391V166.957h33.391v16.696c0,9.22,7.475,16.696,16.696,16.696s16.696-7.475,16.696-16.696v-16.696h166.957v16.696
			c0,9.22,7.475,16.696,16.696,16.696c9.22,0,16.696-7.475,16.696-16.696v-16.696h33.391V317.217z" />
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                <div class="cart-info --cart-info" style="opacity: 0;">
                                    <div class="count --count"></div>
                                    <div class="total"><span class="--total"></span> eur</div>
                                </div>
                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
