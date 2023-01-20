<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="icon" type="image/png" href="/assets/img/corevolut_icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--
    

    <meta http-equiv="refresh" content="5">

    
    -->
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="/"><img src="/assets/img/corevolut_full_logo.png" alt="corevolut"></a>
        </div>
        <div class="header-auth-buttons">
            @auth
                <a {{!Auth::user() ? "href=/login" : "href=/user/".Auth::user()->url_id }}><ion-icon name="person" class="user-header-icons-btn"></ion-icon></a>
                <ion-icon name="notifications" class="user-header-icons-btn" id="user-notifications-button"></ion-icon>
                <a class="white-bg-button" href="/logout">Logout</a>
            @endauth
            @guest
                @if(isset($loginPage))
                    <a class="blue-bg-button" href="/register">Jump in</a>
                @elseif(isset($registerPage))
                    <a class="white-bg-button" href="/login">Login</a>
                @else
                    <a class="white-bg-button" href="/login">Login</a>
                    <a class="blue-bg-button" href="/register">Jump in</a>
                @endif
            @endguest
        </div>
    </header>
    <main>
        @yield('content')
    </main>

    <div class="container">
    <footer>

        @guest
            <h1>Join us!</h1>
            <div class="footer-auth-buttons">
                @if(isset($loginPage))
                    <a class="blue-bg-button" href="/register">Jump in</a>
                @elseif(isset($registerPage))
                    <a class="white-bg-button" href="/login">Login</a>
                @else
                    <a class="white-bg-button" href="/login">Login</a>
                    <a class="blue-bg-button" href="/register">Jump in</a>
                @endif
            </div>
        @endguest
        
        @auth
            <h2>Welcome back, <span class="span-blue-color">{{Auth::user()->first_name}}</span>.</h2>
        @endauth

            <div class="footer-options">
                <div class="footer-more-info">
                    <h3>More info</h3>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a {{!Auth::user() ? "href=/login" : "href=/user/".Auth::user()->url_id }}>My profile</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                </div>
                <div class="footer-search">
                    <h3>Search</h3>
                    <ul>
                        <li><a href="#">All questions</a></li>
                        <li><a href="#">Users</a></li>
                    </ul>
                </div>
                <div class="footer-support">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">F.A.Q</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Open a ticket</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of use</a></li>
                    </ul>
                </div>
            </div>

            <p>Corevolut &copy; 2022</p>
        </footer>
    </div>     
</body>
</html>