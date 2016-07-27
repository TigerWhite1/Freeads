<?php 
use App\Message;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
    {{-- <link href="{{ elixir('css/style.css') }}" rel="stylesheet"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Freeads
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>
                <ul>

                    <div class="col-sm-8 search">
                        {{ Form::model('search', array('url' => 'search', 'method' => 'GET')) }}
                        <div class="form-group1">
                            <div class="input-group1">
                                {{ Form::text('keywords', null, array('class' => 'form-control input-search')) }}
                                <div class="input-group-btn">
                                </div>
                            </div>
                        </div>
                        {{ Form::submit('Search', array('class' => 'btn btn-primary btn-search')) }}
                        {{ Form::close() }}
                        {{ link_to_route('search.store', 'Recherche avancées')}}
                    </div>
                @if (Auth::guest())
                @elseif (!empty(DB::table('emails')->select(DB::raw('count(id) as nbr_email, email_read'))->where('user_id_dest', '=', Auth::user()->id)->where('email_read', '=', 1)->groupBy('email_read')->get()[0]->nbr_email))
                <ul class="nav navbar-nav">
                <li><a href="{{ url('message') }}">New email: {{ DB::table('emails')
                     ->select(DB::raw('count(id) as nbr_email, email_read'))
                     ->where('user_id_dest', '=', Auth::user()->id)
                     ->where('email_read', '=', 1)
                     ->groupBy('email_read')
                     ->get()[0]->nbr_email }}</a></li>

                </ul>
                @endif
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
