<x-videos-app-layout>
    <div class="series-container">
        @if(session('success'))
            <div class="success-message" id="success-message">
                <svg xmlns="http://www.w3.org/2000/svg" class="success-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="series-header">
            <h1 class="series-title">Catàleg de Sèries</h1>

            <form action="{{ route('series.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cerca per títol de la sèrie..." value="{{ request('search') }}">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Cercar
                </button>
            </form>

            @if (Auth::check())
                <a href="{{ route('series.create') }}" class="btn-create-serie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="create-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Crear Serie
                </a>
            @endif
        </div>

        @if($series->isEmpty())
            <div class="no-series">
                <svg xmlns="http://www.w3.org/2000/svg" class="no-series-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <h3>No s'han trobat sèries</h3>
                @if(request('search'))
                    <p>No hi ha resultats per a "{{ request('search') }}". Prova amb una altra cerca.</p>
                @else
                    <p>Encara no hi ha sèries disponibles.</p>
                @endif
            </div>
        @else
            <div class="series-grid">
                @foreach ($series as $serie)
                    <div class="series-card" onclick="window.location='{{ route('series.show', $serie->id) }}'">
                        <div class="series-thumbnail">
                            @if ($serie->image)
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
                            <h3 class="series-info-title">{{ $serie->title }}</h3>
                            <p class="series-info-description">{{ \Str::limit($serie->description, 100) }}</p>
                            <div class="series-meta">
                                <span class="series-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="date-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicada' }}
                                </span>
                                @if($serie->user_name)
                                    <span class="series-author">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="author-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        {{ $serie->user_name }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('series.show', $serie->id) }}" class="btn-view">Veure Detalls</a>
                        </div>
                    </div>
                @endforeach
            </div>
                <div class="pagination">
                    {{ $series->links('pagination::bootstrap-4') }}
                </div>
        @endif
    </div>

    <style>

        .pagination {
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .series-container {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .pagination {
                margin-top: auto;
                display: flex;
                justify-content: center;
                flex-direction: row;
            }
        }

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

        .series-container {
            max-width: 1280px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .series-header {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            align-items: center;
            justify-content: space-between;
        }

        .series-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-color);
            margin: 0;
            flex-basis: 100%;
            text-align: center;
            margin-bottom: 1rem;
        }

        .search-form {
            flex: 1;
            display: flex;
            gap: 0.75rem;
            min-width: 300px;
        }

        .search-form input {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            background-color: var(--card-bg);
            transition: var(--transition);
        }

        .search-form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .search-form button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 0.8rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-form button:hover {
            background-color: var(--primary-hover);
        }

        .search-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .btn-create-serie {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.25rem;
            background-color: #10b981;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-create-serie:hover {
            background-color: #059669;
            transform: translateY(-2px);
        }

        .create-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .success-message {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3.5s forwards;
        }

        .success-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .no-series {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3rem;
            text-align: center;
            color: var(--text-light);
        }

        .no-series-icon {
            width: 3rem;
            height: 3rem;
            stroke: var(--text-light);
            margin-bottom: 1rem;
        }

        .no-series h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .no-series p {
            font-size: 1.125rem;
        }

        .series-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .series-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
            cursor: pointer;
        }

        .series-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .series-thumbnail {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .series-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .series-card:hover .series-image {
            transform: scale(1.05);
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
            width: 3rem;
            height: 3rem;
            stroke: var(--text-light);
        }

        .series-info {
            padding: 1.5rem;
        }

        .series-info-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }

        .series-info-description {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 1.25rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .series-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .series-date, .series-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .date-icon, .author-icon {
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

        @media (max-width: 768px) {
            .series-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-form {
                width: 100%;
            }

            .btn-create-serie {
                width: 100%;
                justify-content: center;
            }

            .series-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .series-title {
                font-size: 1.75rem;
            }

            .series-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    successMessage.style.transform = 'translateY(-10px)';
                }, 4000);
            }
        });
    </script>
</x-videos-app-layout>
