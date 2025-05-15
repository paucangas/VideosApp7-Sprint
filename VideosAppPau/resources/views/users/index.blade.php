<x-videos-app-layout>
    <div class="users-container">
        <div class="users-header">
            <h1 class="page-title">Llista d'Usuaris</h1>
        </div>

        <form method="GET" action="{{ route('users.index') }}" class="search-form">
            <div class="search-bar">
                <input type="text" name="search" class="search-input" placeholder="Cerca un usuari..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" id="error-alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="users-grid">
            @foreach($users as $user)
                <div class="user-card">
                    <div class="user-avatar">
                        @if($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}'s photo" class="avatar-img">
                        @else
                            <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h3 class="user-name">{{ $user->name }}</h3>
                        <p class="user-email">
                            <svg xmlns="http://www.w3.org/2000/svg" class="email-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            {{ $user->email }}
                        </p>
                        <a href="{{ route('users.show', $user->id) }}" class="btn-view">
                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Veure Detall
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $users->links() }}
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

        .users-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .users-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        .search-form {
            max-width: 600px;
            margin: 0 auto 2.5rem;
        }

        .search-bar {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            border-radius: 50px;
            overflow: hidden;
            background-color: var(--card-bg);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .search-bar:focus-within {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        .search-input {
            width: 100%;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            border: none;
            background-color: transparent;
            outline: none;
            color: var(--text-color);
        }

        .search-input::placeholder {
            color: var(--text-light);
        }

        .search-btn {
            position: absolute;
            right: 1rem;
            background: transparent;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            transition: var(--transition);
        }

        .search-btn:hover {
            color: var(--primary-hover);
            transform: scale(1.1);
        }

        .search-icon {
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
            animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3.5s forwards;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
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

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .user-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: var(--transition);
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
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
            font-size: 2rem;
            font-weight: 700;
            color: var(--card-bg);
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        }

        .user-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .user-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0 0 0.5rem;
        }

        .user-email {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: var(--text-light);
            margin: 0 0 1rem;
        }

        .email-icon {
            width: 1rem;
            height: 1rem;
            stroke: var(--text-light);
        }

        .btn-view {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .btn-view:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-icon {
            width: 1rem;
            height: 1rem;
            stroke: currentColor;
        }

        .pagination-container {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .users-container {
                margin: 2rem auto;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .users-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .user-card {
                padding: 1.25rem;
                gap: 1rem;
            }

            .user-avatar {
                width: 60px;
                height: 60px;
            }

            .avatar-placeholder {
                font-size: 1.5rem;
            }

            .user-name {
                font-size: 1.125rem;
            }
        }

        @media (max-width: 480px) {
            .users-grid {
                grid-template-columns: 1fr;
            }

            .search-input {
                padding: 0.875rem 1.25rem;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const successAlert = document.getElementById("success-alert");
            const errorAlert = document.getElementById("error-alert");

            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = "opacity 0.5s ease-out, transform 0.5s ease-out";
                    successAlert.style.opacity = 0;
                    successAlert.style.transform = "translateY(-10px)";
                }, 3000);
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.transition = "opacity 0.5s ease-out, transform 0.5s ease-out";
                    errorAlert.style.opacity = 0;
                    errorAlert.style.transform = "translateY(-10px)";
                }, 3000);
            }
        });
    </script>
</x-videos-app-layout>
