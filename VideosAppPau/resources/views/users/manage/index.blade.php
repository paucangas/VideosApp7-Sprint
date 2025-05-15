<x-videos-app-layout>
    <div class="manage-users-container">
        <div class="manage-header">
            <h1 class="page-title">Gestió d'Usuaris</h1>
            <a href="{{ route('users.manage.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Crear Usuari
            </a>
        </div>

        @if(session('success'))
            <div id="alert-success" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="alert-error" class="alert alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Vista de Taula per a escriptoris --}}
        <div class="table-container desktop-view">
            <table class="users-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('users.manage.edit', $user) }}" class="btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Editar
                            </a>
                            <form action="{{ route('users.manage.destroy', $user) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Estàs segur?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Vista de targetes per a mòbils --}}
        <div class="mobile-view">
            @foreach($users as $user)
                <div class="user-card">
                    <div class="user-card-header">
                        <div class="user-card-avatar">
                            @if($user->profile_photo_url)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="avatar-img">
                            @else
                                <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="user-card-info">
                            <h3 class="user-card-name">{{ $user->name }}</h3>
                            <p class="user-card-email">{{ $user->email }}</p>
                            <p class="user-card-id">ID: {{ $user->id }}</p>
                        </div>
                    </div>
                    <div class="user-card-actions">
                        <a href="{{ route('users.manage.edit', $user) }}" class="card-btn-edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="card-action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('users.manage.destroy', $user) }}" method="POST" class="card-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="card-btn-delete" onclick="return confirm('Estàs segur?')">
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
            @endforeach
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

        .manage-users-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .manage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-color);
            margin: 0;
            letter-spacing: -0.025em;
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--accent-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
        }

        .btn-create:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
        }

        .btn-icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke: currentColor;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out;
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

        .table-container {
            overflow-x: auto;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td {
            padding: 1rem 1.5rem;
            text-align: left;
        }

        .users-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .users-table th:first-child {
            border-top-left-radius: var(--border-radius);
        }

        .users-table th:last-child {
            border-top-right-radius: var(--border-radius);
        }

        .users-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .users-table tr {
            transition: var(--transition);
        }

        .users-table tr:hover {
            background-color: #f1f5f9;
        }

        .actions-cell {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-2px);
        }

        .action-icon {
            width: 1rem;
            height: 1rem;
            stroke: currentColor;
        }

        .inline-form {
            display: inline;
        }

        /* Mobile view */
        .mobile-view {
            display: none;
        }

        .user-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .user-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .user-card-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #e2e8f0;
            flex-shrink: 0;
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
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--card-bg);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        }

        .user-card-info {
            flex-grow: 1;
        }

        .user-card-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0 0 0.25rem;
        }

        .user-card-email {
            font-size: 0.95rem;
            color: var(--text-light);
            margin: 0 0 0.25rem;
        }

        .user-card-id {
            font-size: 0.875rem;
            color: var(--text-light);
            margin: 0;
        }

        .user-card-actions {
            display: flex;
            gap: 1rem;
        }

        .card-btn-edit, .card-btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            flex: 1;
        }

        .card-btn-edit {
            background-color: var(--primary-color);
            color: white;
        }

        .card-btn-edit:hover {
            background-color: var(--primary-hover);
        }

        .card-btn-delete {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            cursor: pointer;
        }

        .card-btn-delete:hover {
            background-color: var(--secondary-hover);
        }

        .card-action-icon {
            width: 1.125rem;
            height: 1.125rem;
            stroke: currentColor;
        }

        .card-delete-form {
            flex: 1;
        }

        @media (max-width: 768px) {
            .desktop-view {
                display: none;
            }

            .mobile-view {
                display: block;
            }

            .manage-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-create {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 1.75rem;
                margin-bottom: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');

            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    successAlert.style.opacity = '0';
                    successAlert.style.transform = 'translateY(-10px)';
                }, 4000);
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transform = 'translateY(-10px)';
                }, 4000);
            }
        });
    </script>
</x-videos-app-layout>
