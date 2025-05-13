<x-videos-app-layout>
    <div class="video-detail-container">
        <div class="video-card">
            <h1 class="video-title">{{ $video->title }}</h1>

            <div class="video-player">
                @php
                    $embedUrl = str_replace("watch?v=", "embed/", $video->url);
                @endphp
                <iframe
                    src="{{ $embedUrl }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <p class="video-description">{{ $video->description }}</p>

            <div class="video-meta">
                <p><strong>Data:</strong> {{ $video->published_at }}</p>
                <p><strong>Anterior:</strong> {{ $video->previous ?? 'Cap' }}</p>
                <p><strong>Següent:</strong> {{ $video->next ?? 'Cap' }}</p>
                <p><strong>Sèrie ID:</strong> {{ $video->series_id ?? 'Cap' }}</p>
            </div>

            @if (auth()->user() && auth()->user()->id == $video['user_id'])
                <div class="video-actions">
                    <a href="{{ route('videos.edit', $video['id']) }}" class="btn edit">✏️ Editar</a>
                    <form action="{{ route('videos.destroy', $video['id']) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete" onclick="return confirm('Estàs segur que vols eliminar aquest vídeo?');">🗑️ Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <style>
        .video-detail-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1rem;
            font-family: 'Segoe UI', sans-serif;
        }

        .video-card {
            background: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.05);
        }

        .video-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            color: #2c3e50;
        }

        .video-player iframe {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .video-description {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: #34495e;
        }

        .video-meta p {
            margin: 0.3rem 0;
            color: #6c757d;
            font-size: 0.95rem;
        }

        .video-actions {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn.edit {
            background-color: #f0ad4e;
            color: white;
        }

        .btn.edit:hover {
            background-color: #ec971f;
        }

        .btn.delete {
            background-color: #d9534f;
            color: white;
        }

        .btn.delete:hover {
            background-color: #c9302c;
        }

        .inline-form {
            display: inline;
        }

        @media (max-width: 600px) {
            .video-title {
                font-size: 1.5rem;
            }

            .video-player iframe {
                height: 250px;
            }
        }
    </style>
</x-videos-app-layout>
