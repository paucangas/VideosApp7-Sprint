<x-videos-app-layout>
    <div class="series-create-container">
        <div class="series-create-card">
            <h1 class="series-create-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
                Crear Nova Sèrie
            </h1>

            @if($errors->any())
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('series.manage.store') }}" method="POST" enctype="multipart/form-data" data-qa="create-series-form" class="series-create-form">
                @csrf

                <div class="form-group">
                    <label for="title">Títol</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required data-qa="input-title">
                </div>

                <div class="form-group">
                    <label for="description">Descripció</label>
                    <textarea name="description" id="description" rows="4" required data-qa="input-description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imatge (Opcional)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" id="image" class="file-input" data-qa="input-image">
                        <div class="file-input-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="file-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span class="file-text">Seleccionar imatge</span>
                        </div>
                    </div>
                    <div id="file-name" class="file-name"></div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-create">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Crear Sèrie
                    </button>
                    <a href="{{ route('series.manage.index') }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        .series-create-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .series-create-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .series-create-title {
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

        .series-create-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: 600;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        input[type="text"], textarea {
            padding: 0.875rem 1rem;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            background-color: var(--input-bg);
            font-size: 1rem;
            color: var(--text-color);
            font-family: inherit;
            transition: var(--transition);
        }

        input[type="text"]:focus, textarea:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background-color: var(--card-bg);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-input-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border: 1px dashed var(--input-border);
            border-radius: 10px;
            background-color: var(--input-bg);
            transition: var(--transition);
        }

        .file-input:focus + .file-input-custom {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .file-input:hover + .file-input-custom {
            background-color: #e2e8f0;
        }

        .file-icon {
            width: 1.5rem;
            height: 1.5rem;
            stroke: var(--text-light);
        }

        .file-text {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .file-name {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-color);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-create, .btn-cancel {
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

        .btn-create {
            background-color: var(--primary-color);
            color: white;
            border: none;
            flex: 2;
        }

        .btn-create:hover {
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

        .btn-icon {
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
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
            margin-top: 0.25rem;
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

        @media (max-width: 768px) {
            .series-create-card {
                padding: 1.5rem;
            }

            .series-create-title {
                font-size: 1.75rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-create, .btn-cancel {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .series-create-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const fileName = document.getElementById('file-name');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                } else {
                    fileName.textContent = '';
                }
            });
        });
    </script>
</x-videos-app-layout>
