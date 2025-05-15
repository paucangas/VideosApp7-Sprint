<x-videos-app-layout>
    <div class="user-detail-container">
        <div class="user-profile-header">
            <h1 class="page-title">Detall de l'Usuari</h1>
        </div>

        <div class="user-profile-card">
            <div class="user-avatar-large">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="avatar-img">
                @else
                    <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
            </div>
            <div class="user-profile-info">
                <h2 class="user-profile-name">{{ $user->name }}</h2>
                <p class="user-profile-email">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    {{ $user->email }}
                </p>
            </div>
        </div>

        <div class="section-divider"></div>

        <div class="user-videos-section">
            <h2 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                Vídeos de l'Usuari
            </h2>

            @if($user->videos->count() > 0)
                <div class="video-grid">
                    @foreach($user->videos as $video)
                        @php
                            preg_match('/(?:\/|v=)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                            $videoId = $matches[1] ?? null;
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : null;
                        @endphp

                        <div class="video-card">
                            <div class="thumbnail-container">
                                @if ($thumbnailUrl)
                                    <a href="{{ route('videos.show', $video->id) }}">
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
                                <a href="{{ route('videos.show', $video->id) }}" class="video-title">
                                    {{ $video->title }}
                                </a>
                                <p class="video-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="date-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($video->published_at)->format('d M, Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-videos">
                    <svg xmlns="http://www.w3.org/2000/svg" class="no-videos-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                    <p>L'usuari no té vídeos.</p>
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
            --accent-color: #10b981;
            --accent-hover: #059669;
            --text-color: #1e293b;
            --text-light: #64748b;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --border-radius: 16px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        .user-detail-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .user-profile-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        .user-profile-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 3rem;
            transition: var(--transition);
        }

        .user-profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .user-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #e2e8f0;
            flex-shrink: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: var(--card-bg);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        }

        .user-profile-info {
            flex-grow: 1;
        }

        .user-profile-name {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.75rem;
        }

        .user-profile-email {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.125rem;
            color: var(--text-light);
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke: var(--primary-color);
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 2rem 0;
        }

        .user-videos-section {
            padding-top: 1rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 2rem;
        }

        .section-icon {
            width: 1.75rem;
            height: 1.75rem;
            stroke: var(--primary-color);
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
            height: 180px;
            overflow: hidden;
        }

        .thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            height: 100%;
            background-color: #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
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
            display: block;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.75rem;
            text-decoration: none;
            transition: color 0.3s ease;
            line-height: 1.4;
        }

        .video-title:hover {
            color: var(--primary-color);
        }

        .video-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-light);
            margin: 0;
        }

        .date-icon {
            width: 1rem;
            height: 1rem;
            stroke: var(--text-light);
        }

        .no-videos {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
        }

        .no-videos-icon {
            width: 4rem;
            height: 4rem;
            stroke: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .no-videos p {
            font-size: 1.125rem;
            color: var(--text-light);
            margin: 0;
        }

        @media (max-width: 768px) {
            .user-profile-card {
                flex-direction: column;
                text-align: center;
                padding: 2rem 1.5rem;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .user-profile-name {
                font-size: 1.5rem;
            }

            .user-profile-email {
                justify-content: center;
            }

            .section-title {
                font-size: 1.5rem;
                justify-content: center;
            }

            .video-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .user-detail-container {
                margin: 2rem auto;
            }

            .video-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-videos-app-layout>
