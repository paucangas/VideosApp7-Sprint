<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        :root {
            /* Color System */
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #f43f5e;
            --accent: #10b981;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .layout {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .app-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .app-logo svg {
            width: 28px;
            height: 28px;
            stroke: var(--primary);
        }

        .nav-container {
            display: flex;
            align-items: center;
        }

        nav {
            display: flex;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 0.75rem;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: var(--transition);
            display: inline-block;
            font-size: 0.95rem;
        }

        nav ul li a:hover {
            background-color: var(--primary);
            color: white;
        }

        .mobile-nav-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-nav-toggle svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary);
        }

        main {
            flex: 1;
            padding: 2rem 1rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.3s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .mobile-nav-toggle {
                display: block;
            }

            nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--card-bg);
                box-shadow: var(--shadow);
                padding: 1rem;
                display: none;
                border-bottom: 1px solid var(--border-color);
            }

            nav.show {
                display: block;
            }

            nav ul {
                flex-direction: column;
                width: 100%;
            }

            nav ul li {
                width: 100%;
            }

            nav ul li a {
                display: block;
                padding: 0.75rem 1rem;
                border-radius: var(--border-radius);
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <header>
        <div class="header-container">
            <a href="/" class="app-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                VideosApp
            </a>

            <div class="nav-container">
                <button class="mobile-nav-toggle" id="mobile-nav-toggle" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <nav id="main-nav">
                    <ul id="nav-menu">
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
            </div>
        </div>
    </header>

    <main>
        {{-- CONTINGUT --}}
        {{ $slot }}
    </main>

    <footer>
        <p>&copy; 2025 Videos App Pau Cangas | Tots els drets reservats</p>
    </footer>
</div>

<script>
    // Mobile navigation toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileNavToggle = document.getElementById('mobile-nav-toggle');
        const mainNav = document.getElementById('main-nav');

        if (mobileNavToggle && mainNav) {
            mobileNavToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mainNav.classList.toggle('show');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (mainNav.classList.contains('show') &&
                    !mainNav.contains(e.target) &&
                    !mobileNavToggle.contains(e.target)) {
                    mainNav.classList.remove('show');
                }
            });
        }

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });
</script>
</body>
</html>
