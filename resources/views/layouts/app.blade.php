<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FAQ Accordion')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>
<body>
    <header class="site-header">
        <div class="wrap header-inner">
            <a class="brand" href="{{ route('faqs.index') }}">FAQ Accordion</a>
            <nav class="nav">
                <a href="{{ route('faqs.index') }}">FAQ</a>
                @auth
                    <a href="{{ route('faqs.manage') }}">Manage</a>
                    <a href="{{ route('faqs.create') }}">Add item</a>
                    <form class="nav-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    <a class="button" href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="wrap">
        @if (session('status'))
            <p class="flash" role="status">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
