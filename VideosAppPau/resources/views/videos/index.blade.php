<x-videos-app-layout>
    <div class="video-container">
        <h1 class="video-title">🎬 Els teus vídeos</h1>

        @if (Auth::check())
            <div class="create-btn-wrapper">
                <a href="{{ route('videos.create') }}" class="create-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Crear Vídeo
                </a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success" id="alert-message">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error" id="alert-message">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="video-grid">
            @foreach ($videos as $video)
                @php
                    preg_match('/(?:\/|v=)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                    $videoId = $matches[1] ?? null;
                    $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
                @endphp

                <div class="video-card">
                    <div class="thumbnail-container">
                        @if ($thumbnailUrl)
                            <a href="{{ url('/video', $video->id) }}">
                                <img src="{{ $thumbnailUrl }}" alt="Miniatura de {{ $video->title }}" class="thumbnail">
                                <div class="play-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </div>
                            </a>
                        @else
                            <div class="no-thumbnail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="no-thumbnail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                                    <line x1="7" y1="2" x2="7" y2="22"></line>
                                    <line x1="17" y1="2" x2="17" y2="22"></line>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <line x1="2" y1="7" x2="7" y2="7"></line>
                                    <line x1="2" y1="17" x2="7" y2="17"></line>
                                    <line x1="17" y1="17" x2="22" y2="17"></line>
                                    <line x1="17" y1="7" x2="22" y2="7"></line>
                                </svg>
                                <span>Miniatura no disponible</span>
                            </div>
                        @endif
                    </div>

                    <div class="video-info">
                        <a href="{{ url('/video', $video->id) }}" class="video-link">
                            {{ $video->title }}
                        </a>
                        <p class="video-date">{{ \Carbon\Carbon::parse($video->published_at)->format('d M, Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #f43f5e;
            --secondary-hover: #e11d48;
            --text-color: #1e293b;
            --text-light: #64748b;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --border-radius: 16px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
        }

        .video-container {
            max-width: 1280px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .video-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--text-color);
            font-weight: 800;
            margin-bottom: 2.5rem;
            letter-spacing: -0.025em;
        }

        .create-btn-wrapper {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .create-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            padding: 0.875rem 1.75rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4);
        }

        .create-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .video-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .thumbnail-container {
            position: relative;
            overflow: hidden;
            height: 180px;
        }

        .thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .video-card:hover .thumbnail {
            transform: scale(1.05);
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .play-button svg {
            width: 24px;
            height: 24px;
            stroke: var(--primary-color);
            margin-left: 4px;
        }

        .video-card:hover .play-button {
            opacity: 1;
        }

        .no-thumbnail {
            background-color: #e2e8f0;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-weight: 500;
            gap: 0.75rem;
        }

        .no-thumbnail-icon {
            width: 2.5rem;
            height: 2.5rem;
            stroke: var(--text-light);
        }

        .video-info {
            padding: 1.25rem;
        }

        .video-link {
            text-decoration: none;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            transition: color 0.3s ease;
            display: block;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .video-link:hover {
            color: var(--primary-color);
        }

        .video-date {
            color: var(--text-light);
            font-size: 0.875rem;
            margin: 0;
        }

        .alert-success, .alert-error {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin: 0 auto 2rem;
            max-width: 800px;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3.5s forwards;
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @media (max-width: 768px) {
            .video-title {
                font-size: 2rem;
            }

            .video-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .video-title {
                font-size: 1.75rem;
            }

            .create-btn {
                width: 100%;
                justify-content: center;
            }

            .video-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        // Desapareix els missatges als 4 segons
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                const alertMessage = document.getElementById('alert-message');
                if (alertMessage) {
                    alertMessage.style.opacity = 0;
                    alertMessage.style.transform = 'translateY(-10px)';
                    alertMessage.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                }
            }, 4000);
        });
    </script>
</x-videos-app-layout>
