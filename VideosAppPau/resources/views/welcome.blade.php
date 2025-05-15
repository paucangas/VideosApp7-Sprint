<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VideosApp Pau</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <style>
        :root {
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

        /* Header & Navigation */
        header {
            background-color: var(--card-bg);
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo svg {
            width: 28px;
            height: 28px;
            stroke: var(--primary);
        }

        nav {
            display: flex;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }

        nav a {
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 600;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: var(--transition);
        }

        nav a:hover {
            background-color: var(--primary);
            color: white;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
        }

        .mobile-menu-btn svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 8rem 1rem 6rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background-color: white;
            color: var(--primary);
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            padding: 5rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .feature-icon svg {
            width: 30px;
            height: 30px;
            stroke: white;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-secondary);
        }

        /* How It Works Section */
        .how-it-works {
            background-color: #f1f5f9;
            padding: 5rem 1rem;
        }

        .steps-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .step h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .step p {
            color: var(--text-secondary);
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 5rem 1rem;
            text-align: center;
        }

        .cta-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        footer {
            background-color: var(--card-bg);
            padding: 3rem 1rem;
            text-align: center;
            color: var(--text-secondary);
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .copyright {
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--card-bg);
                padding: 1rem;
                box-shadow: var(--shadow);
                display: none;
            }

            nav.show {
                display: block;
            }

            nav ul {
                flex-direction: column;
                gap: 0.5rem;
            }

            nav a {
                display: block;
                padding: 0.75rem 1rem;
            }

            .hero h1 {
                font-size: 2.25rem;
            }

            .hero p {
                font-size: 1.125rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cta-section h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <a href="/" class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
            </svg>
            VideosApp
        </a>

        <button class="mobile-menu-btn" id="mobile-menu-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <nav id="main-nav">
            <ul>
                <li><a href="{{ url('videos') }}">Vídeos</a></li>
                <li><a href="{{ url('series') }}">Series</a></li>
                <li><a href="{{ url('users') }}">Usuaris</a></li>
                <li><a href="{{ url('videos/manage') }}">Gestió de vídeos</a></li>
                <li><a href="{{ url('series/manage') }}">Gestió de series</a></li>
                <li><a href="{{ url('users/manage') }}">Gestió d'usuaris</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>La teva plataforma de gestió de vídeos</h1>
        <p>VideosApp et permet organitzar, gestionar i visualitzar els teus vídeos de manera fàcil i intuïtiva. Tot en un sol lloc.</p>
        <div class="cta-buttons">
            <a href="{{ url('videos') }}" class="btn btn-primary">Explorar Vídeos</a>
            <a href="{{ url('series') }}" class="btn btn-secondary">Veure Sèries</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="section-title">
        <h2>Característiques Principals</h2>
        <p>Descobreix tot el que pots fer amb VideosApp</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
            </div>
            <h3>Gestió de Vídeos</h3>
            <p>Organitza i administra tots els teus vídeos en un sol lloc. Afegeix, edita i elimina vídeos fàcilment.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                    <line x1="7" y1="2" x2="7" y2="22"></line>
                    <line x1="17" y1="2" x2="17" y2="22"></line>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <line x1="2" y1="7" x2="7" y2="7"></line>
                    <line x1="2" y1="17" x2="7" y2="17"></line>
                    <line x1="17" y1="17" x2="22" y2="17"></line>
                    <line x1="17" y1="7" x2="22" y2="7"></line>
                </svg>
            </div>
            <h3>Sèries Temàtiques</h3>
            <p>Agrupa els teus vídeos en sèries temàtiques per una millor organització i accés més ràpid.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>Gestió d'Usuaris</h3>
            <p>Administra els permisos i rols dels usuaris de la plataforma segons les seves necessitats.</p>
        </div>
    </div>
</section>

<section class="how-it-works">
    <div class="steps-container">
        <div class="section-title">
            <h2>Com Funciona</h2>
            <p>Comença a utilitzar VideosApp en tres senzills passos</p>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Registra't</h3>
                <p>Crea el teu compte per accedir a totes les funcionalitats de la plataforma.</p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Puja els teus vídeos</h3>
                <p>Afegeix els teus vídeos i organitza'ls en sèries temàtiques.</p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Gestiona i comparteix</h3>
                <p>Administra els teus continguts i comparteix-los amb altres usuaris.</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-container">
        <h2>Comença ara mateix</h2>
        <p>Uneix-te a VideosApp i descobreix una nova manera de gestionar els teus vídeos.</p>
        <div class="cta-buttons">
            <a href="{{ url('videos') }}" class="btn btn-primary">Explorar Plataforma</a>
        </div>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-links">
            <a href="{{ url('/') }}">Inici</a>
            <a href="{{ url('videos') }}">Vídeos</a>
            <a href="{{ url('series') }}">Sèries</a>
            <a href="{{ url('users') }}">Usuaris</a>
        </div>
        <p class="copyright">&copy; 2025 VideosApp Pau Cangas. Tots els drets reservats.</p>
    </div>
</footer>

<script>
    // Mobile navigation toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mainNav = document.getElementById('main-nav');

        if (mobileMenuBtn && mainNav) {
            mobileMenuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mainNav.classList.toggle('show');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (mainNav.classList.contains('show') &&
                    !mainNav.contains(e.target) &&
                    !mobileMenuBtn.contains(e.target)) {
                    mainNav.classList.remove('show');
                }
            });
        }
    });
</script>
</body>
</html>
