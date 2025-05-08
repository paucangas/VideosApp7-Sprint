<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('videos.index') }}">Videos</a></li>
            <li><a href="{{ route('series.index') }}">Series</a></li>

            @if (Auth::check())
                <li><a href="{{ route('users.index') }}">Usuaris</a></li>
            @endif
            @if (Auth::check() && Auth::user()->can('manage-users'))
                <li><a href="{{ route('users.manage.index') }}">Gestió de Usuaris</a></li>
            @endif
            @if (Auth::check() && Auth::user()->can('manage-videos'))
                <li><a href="{{ route('videos.manage.index') }}">Gestió de Vídeos</a></li>
            @endif
            @if (Auth::check() && Auth::user()->can('manage-series'))
                <li><a href="{{ route('series.manage.index') }}">Gestió de Series</a></li>
            @endif
            @if (Auth::check())
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Tancar Sessió</a>
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
    {{ $slot }}
</main>

<footer>
    <p>&copy; 2025 Videos App</p>
</footer>
</body>
</html>
