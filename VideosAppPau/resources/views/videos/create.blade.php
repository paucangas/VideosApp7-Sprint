<x-videos-app-layout>
    <div class="create-container">
        <div class="create-card">
            <h1 class="create-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
                Crear Vídeo
            </h1>

            @if(session('success'))
                <div class="alert success" id="alert-message">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert error" id="alert-message">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('videos.store') }}" method="POST" data-qa="video-create-form" class="create-form">
                @csrf

                <div class="form-group">
                    <label for="title">Títol</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripció</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" required>
                </div>

                <div class="form-group">
                    <label for="published_at">Data de publicació</label>
                    <input type="date" id="published_at" name="published_at" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="previous">Vídeo anterior</label>
                        <input type="text" id="previous" name="previous">
                    </div>

                    <div class="form-group">
                        <label for="next">Vídeo següent</label>
                        <input type="text" id="next" name="next">
                    </div>
                </div>

                <div class="form-group">
                    <label for="series_id">Sèrie</label>
                    <select id="series_id" name="series_id">
                        <option value="">Tria una sèrie</option>
                        @foreach ($series as $serie)
                            <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-create">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Crear Vídeo
                </button>
            </form>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #f43f5e;
            --secondary-hover: #e11d48;
            --success-color: #10b981;
            --error-color: #ef4444;
            --text-color: #1e293b;
            --text-light: #64748b;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --input-bg: #f1f5f9;
            --input-border: #cbd5e1;
            --input-focus: #6366f1;
            --border-radius: 16px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        .create-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .create-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .create-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
        }

        .title-icon {
            width: 2rem;
            height: 2rem;
            stroke: var(--primary-color);
        }

        .create-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        label {
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        input, textarea, select {
            padding: 0.875rem 1rem;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            background-color: var(--input-bg);
            font-size: 1rem;
            color: var(--text-color);
            font-family: inherit;
            transition: var(--transition);
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background-color: var(--card-bg);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-create {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
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
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 3.5s forwards;
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
        }

        .alert.success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .alert.error {
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

        @media (max-width: 768px) {
            .create-card {
                padding: 1.5rem;
            }

            .create-title {
                font-size: 1.75rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .create-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        // Desapareix els missatges als 4 segons
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                const alertMessage = document.getElementById('alert-message');
                if (alertMessage) {
                    alertMessage.style.opacity = 0;
                    alertMessage.style.transform = 'translateY(-10px)';
                    alertMessage.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                }
            }, 4000);
        });
    </script>
</x-videos-app-layout>
