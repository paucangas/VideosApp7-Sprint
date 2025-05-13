<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-3 text-center">{{ $serie->title }}</h1>

        <div class="mb-4 text-center">
            <p class="serie-description">{{ $serie->description }}</p>
        </div>

        <div class="serie-meta d-flex justify-content-center gap-4 mb-5 text-muted">
            <div>
                <strong>Publicada el:</strong>
                {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}
            </div>
            @if($serie->user_name)
                <div class="d-flex align-items-center gap-2">
                    @if($serie->user_photo_url)
                        <img src="{{ $serie->user_photo_url }}" alt="Usuari"
                             class="user-photo">
                    @endif
                    <span><strong>Creada per:</strong> {{ $serie->user_name }}</span>
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
        @endif

        <h3 class="mb-4 text-center">Vídeos associats</h3>

        @if($videos->isEmpty())
            <p class="text-muted text-center">No hi ha vídeos associats a aquesta sèrie.</p>
        @else
            <div class="row">
                @foreach($videos as $video)
                    @php
                        preg_match('/(?:\/|v=)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                        $videoId = $matches[1] ?? null;
                        $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
                    @endphp

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="video-card">
                            @if ($thumbnailUrl)
                                <a href="{{ route('videos.show', $video->id) }}">
                                    <img src="{{ $thumbnailUrl }}" alt="Miniatura de {{ $video->title }}" class="card-img-top">
                                </a>
                            @else
                                <div class="no-thumbnail">Miniatura no disponible</div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $video->title }}</h5>
                                <p class="card-text text-truncate">
                                    {{ \Str::limit($video->description, 60) }}
                                </p>
                                <p class="text-muted mb-1">
                                    Publicat el: {{ $video->created_at->format('d/m/Y') }}
                                </p>
                                <a href="{{ route('videos.show', $video) }}" class="btn btn-outline-primary btn-sm">Veure Detalls</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('series.index') }}" class="btn btn-secondary">← Tornar a les Sèries</a>
        </div>
    </div>

    <style>
        .container {
            padding: 60px 20px;
            max-width: 1200px;
            margin: auto;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .serie-description {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .serie-meta {
            font-size: 14px;
            color: #777;
        }

        .serie-meta strong {
            color: #333;
        }

        .user-photo {
            border-radius: 50%;
            width: 28px;
            height: 28px;
            object-fit: cover;
        }

        .video-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .video-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 16px;
            background-color: #fff;
            border-radius: 0 0 12px 12px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .card-text {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
        }

        .btn-outline-primary {
            color: #3498db;
            border-color: #3498db;
            background-color: transparent;
            font-size: 12px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #3498db;
            color: white;
        }

        .btn-secondary {
            background-color: #3498db;
            border-color: #3498db;
            color: white;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 14px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #0864ac;
            border-color: #0864ac;
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

        @media (max-width: 768px) {
            .video-card {
                margin-bottom: 20px;
            }

            .card-img-top {
                height: 150px;
            }

            .card-title {
                font-size: 13px;
            }

            .card-text {
                font-size: 12px;
            }

            .serie-description {
                font-size: 14px;
            }

            .serie-meta {
                font-size: 12px;
            }
        }
    </style>
</x-videos-app-layout>
