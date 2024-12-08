<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Top Section: Logo and Company Name -->
    <div class="sidebar-top">
        <img src="{{url('assets/logo.png')}}" alt="Logo" class="sidebar-logo">
        <h2 class="company-name">ZENIX Motors</h2>
    </div>

    <!-- Middle Section: Navigation Links -->
    <nav class="sidebar-nav">
        <ul class="sidebar-nav">
            <li class="{{ request()->is('/') || request()->is('welcome') ? 'active' : '' }}">
                <a href="{{ route('welcome') }}" class="text-center">Home</a>
            </li>
            <li class="{{ request()->is('motorcycles') || request()->is('details') ? 'active' : '' }}">
                <a href="{{ route('motorcycles') }}" class="text-center">Motorcycles</a>
            </li>
            <li class="{{ request()->is('accessories') ? 'active' : '' }}">
                <a href="{{ route('accessories') }}" class="text-center">Accessories</a>
            </li>
            <li class="{{ request()->is('cart') ? 'active' : '' }}">
                <a href="{{ route('cart') }}" class="text-center">Cart</a>
            </li>
        </ul>
    </nav>

    <!-- Bottom Section: User Profile -->
    <div class="sidebar-bottom d-flex justify-content-between align-items-center">
        @auth
            <!-- Display username as a link to profile page -->
            <a href="{{ route('profile.edit') }}" class="profile-link my-2 mx-3">
            <i class="fas fa-user"></i>{{ Auth::user()->name }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <!-- Font Awesome logout icon -->
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        @else
            <!-- Display login link if not logged in -->
            <a href="{{ route('login') }}" class="profile-link my-2 m-auto">
                Login
            </a>
        @endauth
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
