<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <link href="{{ asset('assets/css/bootstrap_dark.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/front.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    @include('partials.categories')
                    <li><a href="{{ url('contact') }}">Contact</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::check())
                        <li><a href="{{ url('/bag') }}">Mon panier</a></li>
                        <li><a href="{{ url('/auth/login') }}">Se connecter</a></li>
                        <li><a href="{{ url('/auth/register') }}">S'inscire</a></li>
                    @else
                        <li><a href="{{ url('/admin/products') }}">Retour Dashboard</a></li>
                        <li><a href="{{ url('/auth/logout') }}">Se déconnecter</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        @if(Session::has('message'))
            <blockquote>
                <div class="alert alert-dismissible alert-success">{{ Session::get('message') }}</div>
            </blockquote>
        @endif

        @if(Session::has('error'))
            <blockquote>
                <div class="alert alert-dismissible alert-danger">{{ Session::get('error') }}</div>
            </blockquote>
        @endif

        <div class="row">
            <div class="col-sm-9">
                @yield('content')
            </div>

            <div class="col-sm-3">
                {{--@include('partials.aside1')--}}
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <a href="{{ url('terms') }}">Mentions légales</a>
            <a href="{{ url('contact') }}">Contact</a>
            @include('partials.tags')
        </div>
    </footer>


    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
</body>
</html>