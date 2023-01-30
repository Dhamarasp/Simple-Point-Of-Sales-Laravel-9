<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Alfamarr | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .nav-link.active {
        text-decoration: underline;
        font-weight: bold;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" style="color: red;" href="/home">Alfamarr</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('home')) active @endif" aria-current="page"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('transaction')) active @endif"
                                    href="{{ route('transaction.index') }}">Transaction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('item')) active @endif" aria-current="page"
                                    href="{{ route('item.index') }}">Item</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('category')) active @endif"
                                    href="{{ route('category.index') }}">Category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('history*')) active @endif"
                                    href="{{ route('history.index') }}">History</a>
                            </li>
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-sun-fill theme-icon-active" data-theme-icon-active="bi-sun-fill"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button"
                                            data-bs-theme-value="light">
                                            <i class="bi bi-sun-fill me-2 opacity-50" data-theme-icon="bi-sun-fill"></i>
                                            Light
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button"
                                            data-bs-theme-value="dark">
                                            <i class="bi bi-moon-fill me-2 opacity-50" data-theme-icon="bi-moon-fill"></i>
                                            Dark
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button"
                                            data-bs-theme-value="auto">
                                            <i class="bi bi-circle-half me-2 opacity-50"
                                                data-theme-icon="bi-circle-half"></i>
                                            Auto
                                        </button>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @yield('script')

    <script>
        (() => {
            'use strict'

            const storedTheme = localStorage.getItem('theme')

            const getPreferredTheme = () => {
                if (storedTheme) {
                    return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = function(theme) {
                if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark')
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme)
                }
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = theme => {
                const activeThemeIcon = document.querySelector('.theme-icon-active')
                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                const iconOfActiveBtn = btnToActive.querySelector('i').dataset.themeIcon

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active')
                })

                btnToActive.classList.add('active')
                activeThemeIcon.classList.remove(activeThemeIcon.dataset.themeIconActive)
                activeThemeIcon.classList.add(iconOfActiveBtn)
                activeThemeIcon.dataset.iconActive = iconOfActiveBtn
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (storedTheme !== 'light' || storedTheme !== 'dark') {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })
            })
        })()
    </script>

</body>

</html>
