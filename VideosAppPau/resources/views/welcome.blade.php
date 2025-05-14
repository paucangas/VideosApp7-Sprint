<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VideosApp Pau</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            :root {
                --bg-light: #f8fafc;
                --bg-dark: #0f172a;
                --text-light: #1e293b;
                --text-dark: #cbd5e1;
                --accent: #3b82f6;
            }

            body {
                margin: 0;
                font-family: 'Figtree', sans-serif;
                background-color: var(--bg-light);
                color: var(--text-light);
                transition: all 0.3s ease-in-out;
            }

            body.dark {
                background-color: var(--bg-dark);
                color: var(--text-dark);
            }

            header {
                background-color: var(--accent);
                padding: 1rem 2rem;
                color: white;
                text-align: center;
            }

            nav {
                background-color: #e2e8f0;
                padding: 0.8rem 2rem;
            }

            nav ul {
                list-style: none;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1.5rem;
                margin: 0;
                padding: 0;
            }

            nav a {
                text-decoration: none;
                font-weight: 500;
                color: #1e293b;
                padding: 0.5rem 0.75rem;
                border-radius: 6px;
                transition: background-color 0.2s;
            }

            nav a:hover {
                background-color: #cbd5e1;
            }

            main {
                padding: 2rem;
                text-align: center;
            }

            @media (prefers-color-scheme: dark) {
                body {
                    background-color: var(--bg-dark);
                    color: var(--text-dark);
                }

                nav {
                    background-color: #1e293b;
                }

                nav a {
                    color: #cbd5e1;
                }

                nav a:hover {
                    background-color: #334155;
                }

                header {
                    background-color: #2563eb;
                }
            }
        </style>
    @endif
</head>
<body class="antialiased dark:bg-black dark:text-white/50">
<header>
    <h1>Benvingut a <strong>VideosApp Pau</strong></h1>
</header>

<nav>
    <ul>
        <li><a href="{{ url('/') }}">Inici</a></li>
        <li><a href="{{ url('videos') }}">Vídeos</a></li>
        <li><a href="{{ url('videos/manage') }}">Gestió de vídeos</a></li>
        <li><a href="{{ url('users/manage') }}">Gestió d'usuaris</a></li>
    </ul>
</nav>

<main>
    <p>Explora, gestiona i visualitza vídeos fàcilment.</p>
</main>
</body>
</html>
