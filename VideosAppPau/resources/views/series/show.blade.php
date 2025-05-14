<x-videos-app-layout>
    <div class="series-show-container">
        <div class="series-header">
            <div class="series-image-container">
                @if($serie->image)
                    <img src="{{ asset('storage/images/' . $serie->image) }}" alt="{{ $serie->title }}" class="series-image">
                @else
                    <div class="series-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" class="placeholder-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                            <circle cx="8" cy="8" r="2"></circle>
                            <path d="M21 15l-5-5L5 21"></path>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="series-info">
                <h1 class="series-title">{{ $serie->title }}</h1>
                <p class="series-description">{{ $serie->description }}</p>

                <div class="series-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicada' }}</span>
                    </div>

                    @if($serie->user_name)
                        <div class="meta-item">
                            @if($serie->user_photo_url)
                                <img src="{{ $serie->user_photo_url }}" alt="{{ $serie->user_name }}" class="user-avatar">
                            @else
                                <div class="user-avatar-placeholder">
                                    {{ strtoupper(substr($serie->user_name, 0, 1)) }}
                                </div>
                            @endif
                            <span>{{ $serie->user_name }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="videos-section">
            <h2 class="videos-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                Vídeos associats
            </h2>

            @if($videos->isEmpty())
                <div class="no-videos">
                    <svg xmlns="http://www.w3.org/2000/svg" class="no-videos-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    <p>No hi ha vídeos associats a aquesta sèrie.</p>
                </div>
            @else
                <div class="videos-grid">
                    @foreach($videos as $video)
                        @php
                            preg_match('/(?:\/|v=)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                            $videoId = $matches[1] ?? null;
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
                        @endphp

                        <div class="video-card">
                            <div class="video-thumbnail">
                                @if($thumbnailUrl)
                                    <a href="{{ route('videos.show', $video->id) }}" class="thumbnail-link">
                                        <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}" class="thumbnail-image">
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
                                <h3 class="video-title">
                                    <a href="{{ route('videos.show', $video->id) }}">{{ $video->title }}</a>
                                </h3>
                                <p class="video-description">{{ \Str::limit($video->description, 100) }}</p>
                                <p class="video-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="date-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $video->created_at->format('d/m/Y') }}
                                </p>
                                <a href="{{ route('videos.show', $video) }}" class="btn-view">Veure Detalls</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="back-link-container">
            <a href="{{ route('series.index') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Tornar a les Sèries
            </a>
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

        .series-show-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .series-header {
            display: flex;
            gap: 2.5rem;
            margin-bottom: 3rem;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2.5rem;
        }

        .series-image-container {
            flex: 0 0 300px;
            height: 300px;
            border-radius: calc(var(--border-radius) - 4px);
            overflow: hidden;
        }

        .series-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .series-placeholder {
            width: 100%;
            height: 100%;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-icon {
            width: 4rem;
            height: 4rem;
            stroke: var(--text-light);
        }

        .series-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .series-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 0 0 1rem 0;
            line-height: 1.2;
        }

        .series-description {
            font-size: 1.125rem;
            line-height: 1.7;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .series-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .meta-icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke: var(--text-light);
        }

        .user-avatar {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-avatar-placeholder {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            font-weight: 500;
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

        .videos-section {
            margin-bottom: 3rem;
        }

        .videos-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 1.5rem;
            height: 1.5rem;
            stroke: var(--primary-color);
        }

        .no-videos {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem;
            text-align: center;
            color: var(--text-light);
        }

        .no-videos-icon {
            width: 3rem;
            height: 3rem;
            stroke: var(--text-light);
            margin-bottom: 1rem;
        }

        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .video-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .video-thumbnail {
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .thumbnail-link {
            display: block;
            height: 100%;
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .video-card:hover .thumbnail-image {
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

        .video-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }

        .video-title a {
            color: var(--text-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .video-title a:hover {
            color: var(--primary-color);
        }

        .video-description {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .date-icon {
            width: 1rem;
            height: 1rem;
            stroke: var(--text-light);
        }

        .btn-view {
            display: inline-block;
            padding: 0.625rem 1rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-view:hover {
            background-color: var(--primary-hover);
        }

        .back-link-container {
            text-align: center;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #e2e8f0;
            color: var(--text-color);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            background-color: #cbd5e1;
        }

        .back-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        @media (max-width: 1024px) {
            .series-header {
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem;
            }

            .series-image-container {
                flex: 0 0 auto;
                height: 250px;
                max-width: 100%;
                margin: 0 auto;
            }

            .series-title {
                font-size: 1.75rem;
            }

            .videos-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 640px) {
            .series-title {
                font-size: 1.5rem;
            }

            .series-description {
                font-size: 1rem;
            }

            .videos-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-videos-app-layout>
