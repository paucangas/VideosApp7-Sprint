<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-3 text-center">{{ $serie->title }}</h1>

        <div class="mb-4 text-center">
            <p style="font-size: 16px; color: #444;">{{ $serie->description }}</p>
        </div>

        <div class="d-flex justify-content-center gap-4 mb-5 text-muted" style="font-size: 14px;">
            <div>
                <strong>Publicada el:</strong>
                {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}
            </div>
            @if($serie->user_name)
                <div class="d-flex align-items-center gap-2">
                    @if($serie->user_photo_url)
                        <img src="{{ $serie->user_photo_url }}" alt="Usuari"
                             class="rounded-circle" width="28" height="28" style="object-fit: cover;">
                    @endif
                    <span><strong>Creada per:</strong> {{ $serie->user_name }}</span>
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
        @endif

        <h3 class="mb-4">Vídeos associats</h3>

        @if($videos->isEmpty())
            <p class="text-muted">No hi ha vídeos associats a aquesta sèrie.</p>
        @else
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card border-0 shadow-sm rounded"
                             onclick="window.location='{{ route('videos.show', $video->id) }}'">

                            <iframe class="card-img-top" width="560" height="315"
                                    src="{{ $video->url }}?autoplay=0"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                    style="pointer-events: none;"></iframe>

                            <div class="card-body p-2">
                                <h5 class="card-title text-truncate" style="font-size: 14px; font-weight: 600;">{{ $video->title }}</h5>
                                <p class="card-text text-truncate" style="font-size: 12px; color: #606060;">
                                    {{ \Str::limit($video->description, 60) }}
                                </p>
                                <p class="text-muted mb-1" style="font-size: 12px;">
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
        }

        .serie-description {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
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
        }

        .video-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
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

        .btn-primary {
            background-color: #0069d9;
            border-color: #0069d9;
            color: white;
            font-size: 12px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 14px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
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
                font-size: 11px;
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
