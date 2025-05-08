<x-videos-app-layout>
    <div class="series-container">
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form action="{{ route('series.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Cerca per títol de la sèrie..." value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i> Cercar</button>
        </form>

        <div class="series-grid">
            @foreach ($series as $serie)
                <div class="series-card" onclick="window.location='{{ route('series.show', $serie->id) }}'">
                    <div class="series-thumbnail">
                        🎬
                    </div>

                    <div class="series-info">
                        <h5 class="series-title">{{ $serie->title }}</h5>
                        <p class="series-description">{{ \Str::limit($serie->description, 60) }}</p>
                        <p class="series-date">
                            {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicada' }}
                        </p>

                        @if ($serie->user_name)
                            <div class="series-user">
                                @if ($serie->user_photo_url)
                                    <img src="{{ $serie->user_photo_url }}" alt="Foto de perfil" class="avatar">
                                @else
                                    <div class="avatar alt-avatar">
                                        {{ strtoupper(substr($serie->user_name, 0, 1)) }}
                                    </div>
                                @endif
                                <span>{{ $serie->user_name }}</span>
                            </div>
                        @endif

                        <a href="{{ route('series.show', $serie->id) }}" class="btn-view">Veure Detall</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .series-container {
            padding: 50px 20px;
            max-width: 1200px;
            margin: auto;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .success-message {
            background-color: #e6ffed;
            border-left: 6px solid #2ecc71;
            padding: 16px;
            border-radius: 8px;
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .search-form input[type="text"] {
            flex-grow: 1;
            padding: 12px;
            border: 1px solid #dcdde1;
            border-radius: 8px;
            font-size: 16px;
        }

        .search-form button {
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #2980b9;
        }

        .series-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .series-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .series-card:hover {
            transform: translateY(-5px);
        }

        .series-thumbnail {
            background-color: #f7f7f7;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #ccc;
        }

        .series-info {
            padding: 16px;
        }

        .series-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .series-description {
            font-size: 14px;
            color: #606060;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .series-date {
            font-size: 12px;
            color: #999;
            margin: 8px 0;
        }

        .series-user {
            display: flex;
            align-items: center;
            margin-top: 8px;
            font-size: 13px;
        }

        .avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 6px;
        }

        .alt-avatar {
            background-color: #bbb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .btn-view {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 12px;
            border: 1px solid #3498db;
            color: #3498db;
            border-radius: 6px;
            font-size: 13px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-view:hover {
            background-color: #3498db;
            color: white;
        }

        @media (max-width: 600px) {
            .search-form {
                flex-direction: column;
            }

            .search-form button {
                width: 100%;
            }
        }
    </style>
</x-videos-app-layout>
