<x-videos-app-layout>
    <div class="manage-container">
        <div class="manage-header">
            <h1 class="manage-title">Gestió de Vídeos</h1>
            <a href="{{ route('videos.manage.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Crear Vídeo
            </a>
        </div>

        <!-- Missatge d'èxit -->
        @if (session('success'))
            <div id="flash-message" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Missatge d'error -->
        @if (session('error'))
            <div id="flash-message" class="alert alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Taula per a pantalles més grans -->
        <div class="table-container">
            <table class="manage-table">
                <thead>
                <tr>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>URL</th>
                    <th>Data</th>
                    <th>Sèrie</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td class="title-cell">{{ $video->title }}</td>
                        <td class="description-cell">{{ \Str::limit($video->description, 50) }}</td>
                        <td class="url-cell">
                            <a href="{{ $video->url }}" target="_blank" class="url-link">
                                <svg xmlns="http://www.w3.org/2000/svg" class="url-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                                Veure
                            </a>
                        </td>
                        <td class="date-cell">{{ \Carbon\Carbon::parse($video->published_at)->format('d/m/Y') }}</td>
                        <td class="series-cell">{{ $video->series_id ?: 'Cap' }}</td>
                        <td class="actions-cell">
                            <div class="action-buttons">
                                <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    <span>Editar</span>
                                </a>
                                <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estas segur de que vols eliminiar el vídeo?');" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        <span>Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mode responsive - mostrar vídeos com a llista -->
        <div class="video-cards">
            @foreach ($videos as $video)
                <div class="video-card">
                    <h3 class="video-card-title">{{ $video->title }}</h3>

                    <div class="video-card-content">
                        <div class="video-card-info">
                            <p class="video-card-description">{{ \Str::limit($video->description, 100) }}</p>
                            <p class="video-card-meta">
                                <span class="meta-label">Data:</span>
                                <span class="meta-value">{{ \Carbon\Carbon::parse($video->published_at)->format('d/m/Y') }}</span>
                            </p>
                            <p class="video-card-meta">
                                <span class="meta-label">Sèrie:</span>
                                <span class="meta-value">{{ $video->series_id ?: 'Cap' }}</span>
                            </p>
                            <a href="{{ $video->url }}" target="_blank" class="video-card-link">
                                <svg xmlns="http://www.w3.org/2000/svg" class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                                Veure vídeo
                            </a>
                        </div>

                        <div class="video-card-actions">
                            <a href="{{ route('videos.manage.edit', $video->id) }}" class="card-btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="card-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Editar
                            </a>
                            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estas segur de que vols eliminiar el vídeo?');" class="card-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="card-btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="card-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
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

        .manage-container {
            max-width: 1280px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .manage-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 0;
        }

        .btn-create {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-create:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
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

        .alert-danger {
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

        .table-container {
            overflow-x: auto;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .manage-table {
            width: 100%;
            border-collapse: collapse;
        }

        .manage-table th,
        .manage-table td {
            padding: 1rem;
            text-align: left;
        }

        .manage-table th {
            background-color: #f1f5f9;
            font-weight: 600;
            color: var(--text-color);
            position: sticky;
            top: 0;
        }

        .manage-table tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s ease;
        }

        .manage-table tr:hover {
            background-color: #f8fafc;
        }

        .manage-table tr:last-child {
            border-bottom: none;
        }

        .title-cell {
            font-weight: 600;
            color: var(--text-color);
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .description-cell {
            color: var(--text-light);
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .url-cell {
            max-width: 150px;
        }

        .url-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .url-link:hover {
            color: var(--primary-hover);
        }

        .url-icon {
            width: 1rem;
            height: 1rem;
        }

        .date-cell {
            color: var(--text-light);
            white-space: nowrap;
        }

        .series-cell {
            color: var(--text-light);
        }

        .actions-cell {
            white-space: nowrap;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: var(--transition);
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .btn-edit:hover {
            background-color: #bae6fd;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .btn-delete:hover {
            background-color: #fecaca;
        }

        .action-icon {
            width: 1rem;
            height: 1rem;
        }

        .delete-form {
            margin: 0;
        }

        /* Responsive cards for mobile */
        .video-cards {
            display: none;
        }

        @media (max-width: 1024px) {
            .table-container {
                display: none;
            }

            .video-cards {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .video-card {
                background-color: var(--card-bg);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                overflow: hidden;
            }

            .video-card-title {
                padding: 1rem;
                margin: 0;
                font-size: 1.125rem;
                font-weight: 600;
                color: var(--text-color);
                background-color: #f1f5f9;
                border-bottom: 1px solid #e2e8f0;
            }

            .video-card-content {
                padding: 1rem;
            }

            .video-card-info {
                margin-bottom: 1.5rem;
            }

            .video-card-description {
                margin: 0 0 1rem 0;
                color: var(--text-color);
            }

            .video-card-meta {
                margin: 0.5rem 0;
                font-size: 0.875rem;
                color: var(--text-light);
            }

            .meta-label {
                font-weight: 600;
                color: var(--text-color);
            }

            .video-card-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                margin-top: 0.5rem;
            }

            .link-icon {
                width: 1rem;
                height: 1rem;
            }

            .video-card-actions {
                display: flex;
                gap: 1rem;
                border-top: 1px solid #e2e8f0;
                padding-top: 1rem;
            }

            .card-btn-edit, .card-btn-delete {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.75rem;
                border-radius: 6px;
                font-weight: 500;
                font-size: 0.875rem;
                transition: var(--transition);
                text-decoration: none;
                border: none;
                cursor: pointer;
            }

            .card-btn-edit {
                background-color: #e0f2fe;
                color: #0284c7;
            }

            .card-btn-delete {
                background-color: #fee2e2;
                color: #ef4444;
            }

            .card-action-icon {
                width: 1rem;
                height: 1rem;
            }

            .card-delete-form {
                flex: 1;
                margin: 0;
            }
        }

        @media (max-width: 640px) {
            .manage-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-create {
                width: auto;
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(function() {
                    flashMessage.style.opacity = '0';
                    flashMessage.style.transform = 'translateY(-10px)';
                }, 4000);
            }
        });
    </script>
</x-videos-app-layout>
