<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <link href="{{ asset('assets/css/bootstrap_dark.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/front.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        html, body, header.home { height: 100%; }
        #container_products { margin-top: 0; }
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
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
                        <li><a href="{{ url('/bag') }}">
                                @if (Session::has('panier'))
                                    <i class="fa fa-cart-arrow-down"></i>
                                @endif
                                Mon panier
                            </a>
                        </li>
                        <li><a href="{{ url('/auth/login') }}">Se connecter (admin)</a></li>
                        <li><a href="{{ url('/auth/register') }}">S'inscire</a></li>
                    @else
                        <li><a href="{{ url('/admin/products') }}">Retour Dashboard</a></li>
                        <li><a href="{{ url('/auth/logout') }}">Se déconnecter</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="home">
        <article class="container">
            <h1><a href="{{ url('/') }}"><img src="{{ url(asset('assets/img/logo.png')) }}" alt="logo"></a></h1>
            <p>Star Wars Collection</p>

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
        </article>
    </header>

    <div id="container_page_home">
        <div class="container" id="container_products">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled navfooter">
                        <li><a href="{{ url('/') }}">Accueil</a></li>|{{--
                    --}}<li><a href="{{ url('/terms') }}">Mentions légales</a></li>|{{--
                    --}}<li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.tags')
                </div>
            </div>
            Pierre Martin - <a href="http://pierredesigner.com/" target="_blank">pierredesigner.com</a>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/front.min.js') }}"></script>
    <script src="{{ asset('assets/js/home.min.js') }}"></script>
</body>
</html>