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
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="/assets/img/corevolut_full_logo.png" alt="corevolut">
        </div>
        <div class="header-auth-buttons">
            <button class="white-bg-button">Login</button>
            <button class="blue-bg-button">Jump in</button>
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <div class="container">
    <footer>

            <h1>Join us!</h1>

            <div class="footer-auth-buttons">
                <button class="white-bg-button">Login</button>
                <button class="blue-bg-button">Jump in</button>
            </div>

            <div class="footer-options">
                <div class="footer-more-info">
                    <h3>More info</h3>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="#">My profile</a></li>
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