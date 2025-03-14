<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ Request::root() }}/css/app.css" type="text/css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar">
        <div style="display: flex; align-items: center; font-weight: 900; gap: 10px;">
            <img src="{{ Request::root() }}/logo.png" alt="">
            Agence
        </div>

        <div class="topnav" id="myTopnav" style="margin-left: auto; display: flex; gap: 20px; align-items: center;">
            <div>
                <a href="{{ route('admin.property') }}" @if (Route::is('admin.property')) class="selected" @endif style="font-size: 15px">Annonces</a>
            </div>
            <div>
                <a href="{{ route('admin.option') }}" @if (Route::is('admin.option')) class="selected" @endif style="font-size: 15px">Options</a>
            </div>

            @auth
                <a href="{{ route('home') }}" class="bg-red">Accueil</a>
                
                <form class="" action="{{ route('auth.logout') }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="bg-red" style="height: 100%">Déconnexion</button>
                </form>
            @endauth
        </div>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>

    <div id="menu" class="shadow" style="margin: auto; display: none; gap: 20px; align-items: center; padding: 10px; flex-direction: column; background-color: rgba(0, 0, 0, 0.15); width: fit-content; border-radius: 10px;">
        <div>
            <a href="{{ route('admin.property') }}" @if (Route::is('admin.property')) class="selected" @endif style="font-size: 15px">Annonces</a>
        </div>

        <div>
            <a href="{{ route('admin.option') }}" @if (Route::is('admin.option')) class="selected" @endif style="font-size: 15px">Options</a>
        </div>

        @auth
            <a href="{{ route('home') }}" class="bg-red">Accueil</a>
            
            <form class="" action="{{ route('auth.logout') }}" method="post">
                @method("delete")
                @csrf
                <button class="bg-red" style="height: 100%">Déconnexion</button>
            </form>
        @endauth
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

<script>
    window.onresize = function(event) {
        if (window.innerWidth > 810) {
            var x = document.getElementById("menu");
            x.style.display = "none";
        }
    };

    function myFunction() {
        var x = document.getElementById("menu");

        if (x.style.display === "none") {
            x.style.animationName = "slidein";
            x.style.display = "flex";

        } else {
            x.style.animationName = "slideout";
            
            setTimeout(() => {
                x.style.display = "none";
            }, 800);
        }
    }
</script>