<x-videos-app-layout>
    <div class="video-container">
        <h1 class="video-title">🎬 Els teus vídeos 🎬</h1>

        @if (Auth::check())
            <div class="create-btn-wrapper">
                <a href="{{ route('videos.create') }}" class="create-btn">Crear Vídeo</a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
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
                    @if ($thumbnailUrl)
                        <a href="{{ url('/video', $video->id) }}">
                            <img src="{{ $thumbnailUrl }}" alt="Miniatura de {{ $video->title }}" class="thumbnail">
                        </a>
                    @else
                        <div class="no-thumbnail">Miniatura no disponible</div>
                    @endif

                    <div class="video-info">
                        <a href="{{ url('/video', $video->id) }}" class="video-link">
                            {{ $video->title }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9fb;
            margin: 0;
            padding: 0;
        }

        .video-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        .video-title {
            text-align: center;
            font-size: 2.5rem;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .create-btn-wrapper {
            text-align: center;
            margin-bottom: 2rem;
        }

        .create-btn {
            background-color: #4e73df;
            color: #fff;
            padding: 0.8rem 1.6rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .create-btn:hover {
            background-color: #375bd4;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .video-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        }

        .thumbnail {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .no-thumbnail {
            background-color: #ecf0f1;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 180px;
            font-weight: 600;
        }

        .video-info {
            padding: 1rem;
            text-align: center;
        }

        .video-link {
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            transition: color 0.3s ease;
        }

        .video-link:hover {
            color: #4e73df;
        }

        @media (max-width: 500px) {
            .video-title {
                font-size: 2rem;
            }

            .create-btn {
                width: 100%;
            }
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem auto;
            max-width: 800px;
            text-align: center;
            font-weight: 600;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem auto;
            max-width: 800px;
            text-align: center;
            font-weight: 600;
        }

    </style>

    <script>
        // Desapareix els missatges als 4 segons
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                const successAlert = document.querySelector('.alert-success');
                const errorAlert = document.querySelector('.alert-error');

                if (successAlert) {
                    successAlert.style.opacity = 0;
                }

                if (errorAlert) {
                    errorAlert.style.opacity = 0;
                }
            }, 4000);
        });
    </script>
</x-videos-app-layout>
