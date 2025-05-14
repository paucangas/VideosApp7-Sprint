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
                <div class="meta-item">
                    <span class="meta-label">Data:</span>
                    <span class="meta-value">{{ $video->published_at }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Anterior:</span>
                    <span class="meta-value">{{ $video->previous ?? 'Cap' }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Següent:</span>
                    <span class="meta-value">{{ $video->next ?? 'Cap' }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Sèrie ID:</span>
                    <span class="meta-value">{{ $video->series_id ?? 'Cap' }}</span>
                </div>
            </div>

            @if (auth()->user() && auth()->user()->id == $video['user_id'])
                <div class="video-actions">
                    <a href="{{ route('videos.edit', $video['id']) }}" class="btn edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Editar
                    </a>
                    <form action="{{ route('videos.destroy', $video['id']) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete" onclick="return confirm('Estàs segur que vols eliminar aquest vídeo?');">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
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

        .video-detail-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .video-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .video-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-color);
            line-height: 1.2;
        }

        .video-player {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: calc(var(--border-radius) - 4px);
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .video-player iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: calc(var(--border-radius) - 4px);
        }

        .video-description {
            font-size: 1.125rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            color: var(--text-color);
            padding: 0 0.5rem;
        }

        .video-meta {
            background-color: var(--bg-color);
            padding: 1.5rem;
            border-radius: calc(var(--border-radius) - 4px);
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .meta-label {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.875rem;
        }

        .meta-value {
            color: var(--text-color);
            font-size: 1rem;
        }

        .video-actions {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .btn.edit {
            background-color: var(--primary-color);
            color: white;
            width: auto;
        }

        .btn.edit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn.delete {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn.delete:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-2px);
        }

        .inline-form {
            display: inline;
        }

        @media (max-width: 768px) {
            .video-title {
                font-size: 1.75rem;
            }

            .video-card {
                padding: 1.5rem;
            }

            .video-meta {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .video-title {
                font-size: 1.5rem;
            }

            .video-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</x-videos-app-layout>
