<x-videos-app-layout>
    <div class="create-container">
        <div class="create-card">
            <h1 class="create-title">Crear Vídeo</h1>

            @if (session('success'))
                <div class="alert alert-success" data-qa="success-message" id="alert-message">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error" data-qa="error-message" id="alert-message">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('videos.manage.store') }}" method="POST" data-qa="video-create-form" class="create-form">
                @csrf
                <div class="form-group">
                    <label for="title" data-qa="title-label">Títol</label>
                    <input type="text" class="form-control" id="title" name="title" required data-qa="title-input">
                </div>

                <div class="form-group">
                    <label for="description" data-qa="description-label">Descripció</label>
                    <textarea class="form-control" id="description" name="description" data-qa="description-input" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="url" data-qa="url-label">URL</label>
                    <input type="url" class="form-control" id="url" name="url" required data-qa="url-input">
                </div>

                <div class="form-group">
                    <label for="published_at" data-qa="published_at-label">Data de publicació</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" required data-qa="published_at-input">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="previous" data-qa="previous-label">Vídeo anterior</label>
                        <input type="text" class="form-control" id="previous" name="previous" data-qa="previous-input">
                    </div>

                    <div class="form-group">
                        <label for="next" data-qa="next-label">Vídeo següent</label>
                        <input type="text" class="form-control" id="next" name="next" data-qa="next-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="series_id">Sèrie</label>
                    <select class="form-control" id="series_id" name="series_id">
                        <option value="">Tria una sèrie</option>
                        @foreach ($series as $serie)
                            <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit" data-qa="submit-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Crear Vídeo
                    </button>
                    <a href="{{ route('videos.manage.index') }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Cancel·lar
                    </a>
                </div>
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
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
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

        .form-control {
            padding: 0.875rem 1rem;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            background-color: var(--input-bg);
            font-size: 1rem;
            color: var(--text-color);
            font-family: inherit;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background-color: var(--card-bg);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-submit, .btn-cancel {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            flex: 2;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #e2e8f0;
            color: var(--text-color);
            border: none;
            flex: 1;
        }

        .btn-cancel:hover {
            background-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out;
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
            margin-top: 0.25rem;
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

        .error-list {
            margin: 0;
            padding-left: 1.25rem;
        }

        .error-list li {
            margin-bottom: 0.25rem;
        }

        .error-list li:last-child {
            margin-bottom: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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

            .form-actions {
                flex-direction: column;
            }

            .btn-submit, .btn-cancel {
                width: auto;
            }
        }

        @media (max-width: 480px) {
            .create-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flash = document.getElementById('alert-message');
            if (flash) {
                setTimeout(() => {
                    flash.style.opacity = 0;
                    flash.style.transform = 'translateY(-10px)';
                    flash.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                }, 4000);
            }
        });
    </script>
</x-videos-app-layout>
