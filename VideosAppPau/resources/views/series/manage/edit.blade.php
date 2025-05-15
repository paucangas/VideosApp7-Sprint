<x-videos-app-layout>
    <div class="series-edit-container">
        <div class="series-edit-card">
            <h1 class="series-edit-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Editar Sèrie: {{ $serie->title }}
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

            <form action="{{ route('series.manage.update', $serie) }}" method="POST" enctype="multipart/form-data" data-qa="edit-series-form" class="series-edit-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Títol</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $serie->title) }}" required data-qa="input-title">
                </div>

                <div class="form-group">
                    <label for="description">Descripció</label>
                    <textarea name="description" id="description" rows="4" required data-qa="input-description">{{ old('description', $serie->description) }}</textarea>
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
                            <span class="file-text">Seleccionar nova imatge</span>
                        </div>
                    </div>
                    <div id="file-name" class="file-name"></div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-update">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Actualitzar Sèrie
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

        .series-edit-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .series-edit-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .series-edit-title {
            display: flex;
            overflow: hidden;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 2rem;
            line-height: 1.3;
        }

        .title-icon {
            width: 1.75rem;
            height: 1.75rem;
            stroke: var(--primary-color);
            flex-shrink: 0;
        }

        .series-edit-form {
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

        .btn-update, .btn-cancel {
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

        .btn-update {
            background-color: var(--primary-color);
            color: white;
            border: none;
            flex: 2;
        }

        .btn-update:hover {
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
            .series-edit-card {
                padding: 1.5rem;
            }

            .series-edit-title {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-update, .btn-cancel {
                width: auto;
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
