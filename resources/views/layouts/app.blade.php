<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Articles</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/foundation.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/app.css')}}" />
    <!-- Remove style.css on production -->
</head>
<body id="app-layout">
    <div class="top-bar">
        <div class="row">
            <div class="top-bar-left">
                <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">Articles</li>
                    <li><a href="{{ route('articles.index')}}">View articles</a></li>
                    <li><a href="{{ route('articles.create')}}">New Article</a></li>
                </ul>
            </div>
            <div class="top-bar-right">
                <ul class="menu">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <ul class="dropdown menu" data-dropdown-menu>
                            <li>
                                <a href="#">{{Auth::user()->name}}</a>
                                <ul class="menu vertical">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{URL::asset('assets/js/vendor/jquery.js')}}"></script>
    <script src="{{URL::asset('assets/js/vendor/foundation.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/app.js')}}"></script>
</body>
</html>
