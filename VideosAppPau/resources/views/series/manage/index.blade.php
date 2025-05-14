<x-videos-app-layout>
    <div class="series-manage-container">
        <div class="manage-header">
            <h1 class="manage-title">Gestió de Sèries</h1>
            <a href="{{ route('series.manage.create') }}" class="btn-create" data-qa="create-series">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Crear Sèrie
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" id="alert-error">
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
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>Data de Publicació</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td class="id-cell">{{ $serie->id }}</td>
                        <td class="title-cell">{{ $serie->title }}</td>
                        <td class="description-cell">{{ \Str::limit($serie->description, 50) }}</td>
                        <td class="date-cell">{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicat' }}</td>
                        <td class="actions-cell">
                            <div class="action-buttons">
                                <a href="{{ route('series.manage.edit', $serie) }}" class="btn-edit" data-qa="edit-series-{{ $serie->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    <span>Editar</span>
                                </a>
                                <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" style="display:inline;" data-qa="delete-series-{{ $serie->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Estàs segur que vols eliminar aquesta sèrie? Els vídeos associats també seran desassignats.')">
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

        <!-- Mode responsive per a pantalles petites -->
        <div class="series-cards">
            @foreach($series as $serie)
                <div class="series-card">
                    <h3 class="series-card-title">{{ $serie->title }}</h3>
                    <div class="series-card-content">
                        <div class="series-card-info">
                            <p class="series-card-description">{{ \Str::limit($serie->description, 100) }}</p>
                            <p class="series-card-meta">
                                <span class="meta-label">ID:</span>
                                <span class="meta-value">{{ $serie->id }}</span>
                            </p>
                            <p class="series-card-meta">
                                <span class="meta-label">Data de publicació:</span>
                                <span class="meta-value">{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicat' }}</span>
                            </p>
                        </div>
                        <div class="series-card-actions">
                            <a href="{{ route('series.manage.edit', $serie) }}" class="card-btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="card-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Editar
                            </a>
                            <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquesta sèrie? Els vídeos associats també seran desassignats.');" class="card-delete-form">
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

        .series-manage-container {
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

        .alert-error {
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

        .id-cell {
            font-weight: 600;
            color: var(--text-color);
            width: 60px;
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
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date-cell {
            color: var(--text-light);
            white-space: nowrap;
            width: 150px;
        }

        .actions-cell {
            white-space: nowrap;
            width: 200px;
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

        /* Responsive cards for mobile */
        .series-cards {
            display: none;
        }

        @media (max-width: 1024px) {
            .table-container {
                display: none;
            }

            .series-cards {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .series-card {
                background-color: var(--card-bg);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                overflow: hidden;
            }

            .series-card-title {
                padding: 1rem;
                margin: 0;
                font-size: 1.125rem;
                font-weight: 600;
                color: var(--text-color);
                background-color: #f1f5f9;
                border-bottom: 1px solid #e2e8f0;
            }

            .series-card-content {
                padding: 1rem;
            }

            .series-card-info {
                margin-bottom: 1.5rem;
            }

            .series-card-description {
                margin: 0 0 1rem 0;
                color: var(--text-color);
            }

            .series-card-meta {
                margin: 0.5rem 0;
                font-size: 0.875rem;
                color: var(--text-light);
            }

            .meta-label {
                font-weight: 600;
                color: var(--text-color);
            }

            .series-card-actions {
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
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');

            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.opacity = '0';
                    successAlert.style.transform = 'translateY(-10px)';
                }, 4000);
            }

            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transform = 'translateY(-10px)';
                }, 4000);
            }
        });
    </script>
</x-videos-app-layout>
