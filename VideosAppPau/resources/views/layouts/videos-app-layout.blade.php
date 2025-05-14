<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <style>
        :root {
            --primary: #1e88e5;
            --danger: #e53935;
            --success: #43a047;
            --bg: #f4f6f8;
            --dark: #2c3e50;
            --light: #ffffff;
            --font: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            font-family: var(--font);
            background-color: var(--bg);
            color: var(--dark);
        }

        header {
            background-color: var(--light);
            border-bottom: 1px solid #ddd;
            padding: 1rem 2rem;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        nav ul li a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        nav ul li a:hover {
            background-color: var(--primary);
            color: white;
        }

        .mobile-nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        main {
            padding: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
            transition: opacity 0.5s ease;
        }

        .alert-success {
            background-color: var(--success);
            color: white;
        }

        .alert-error {
            background-color: var(--danger);
            color: white;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: var(--light);
            border-top: 1px solid #ddd;
            color: #888;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .mobile-nav-toggle {
                display: block;
            }

            nav ul {
                display: none;
                flex-direction: column;
                gap: 0;
            }

            nav ul.show {
                display: flex;
            }

            nav ul li {
                border-top: 1px solid #ddd;
                padding: 0.5rem 0;
            }
        }
        html, body {
            height: 100%;
        }

        .layout {
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

    </style>
</head>
<body>
<div class="layout">
<header>
    <button class="mobile-nav-toggle" onclick="document.querySelector('nav ul').classList.toggle('show')">☰</button>
    <nav>
        <ul>
            <li><a href="{{ route('videos.index') }}">Vídeos</a></li>
            <li><a href="{{ route('series.index') }}">Sèries</a></li>
            @if (Auth::check())
                <li><a href="{{ route('users.index') }}">Usuaris</a></li>
                @can('manage-users')
                    <li><a href="{{ route('users.manage.index') }}">Gestió Usuaris</a></li>
                @endcan
                @can('manage-videos')
                    <li><a href="{{ route('videos.manage.index') }}">Gestió Vídeos</a></li>
                @endcan
                @can('manage-series')
                    <li><a href="{{ route('series.manage.index') }}">Gestió Sèries</a></li>
                @endcan
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Tancar Sessió
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <li><a href="{{ route('login') }}">Iniciar Sessió</a></li>
            @endif
        </ul>
    </nav>
</header>

<main>

    {{-- CONTINGUT --}}
    {{ $slot }}
</main>

<footer>
    <p>&copy; 2025 Videos App Pau Cangas </p>
</footer>
    </div>
</body>
</html>
