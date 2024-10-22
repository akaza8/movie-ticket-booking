<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('assets/styles/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/user.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <title>Movie Booking System</title>
</head>

<body>
    <div class="navbar">
        <h1 class="logo ms-2">flakes</h1>
        <div class="profile-container">
            @if (Auth::check())
                <span class="profile-text ">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger me-3">LogOut</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="profile-text me-3">LogIn</a>
                <a href="{{ route('register') }}" class="profile-text me-3">Register</a>
            @endif
            {{-- Live search bar --}}
            @yield('search-bar')

        </div>
    </div>


    <div class="content-container">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/welcome.js') }}"></script>
    <script src="{{ asset('assets/js/userscript.js') }}"></script>
    @yield('scripts')
</body>

</html>
