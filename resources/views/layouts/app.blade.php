<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <a href="{{ route('login') }}">Log in</a>

            <a href="{{ route('register') }}">Register</a>
            
            <a href="{{ route('profile') }}">Profile</a>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>