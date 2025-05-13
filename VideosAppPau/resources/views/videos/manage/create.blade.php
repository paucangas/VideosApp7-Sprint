<x-videos-app-layout>
    <div class="video-create-container">
        <h1 class="form-title">Crear Vídeo</h1>

        @if (session('success'))
            <div class="alert alert-success" data-qa="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" data-qa="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('videos.manage.store') }}" method="POST" data-qa="video-create-form" class="video-form">
            @csrf
            <div class="form-group">
                <label for="title" data-qa="title-label">Títol</label>
                <input type="text" class="form-control" id="title" name="title" required data-qa="title-input">
            </div>

            <div class="form-group">
                <label for="description" data-qa="description-label">Descripció</label>
                <textarea class="form-control" id="description" name="description" data-qa="description-input"></textarea>
            </div>

            <div class="form-group">
                <label for="url" data-qa="url-label">URL</label>
                <input type="url" class="form-control" id="url" name="url" required data-qa="url-input">
            </div>

            <div class="form-group">
                <label for="published_at" data-qa="published_at-label">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" required data-qa="published_at-input">
            </div>

            <div class="form-group">
                <label for="previous" data-qa="previous-label">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous" data-qa="previous-input">
            </div>

            <div class="form-group">
                <label for="next" data-qa="next-label">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next" data-qa="next-input">
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

            <button type="submit" class="btn-submit" data-qa="submit-button">Crear Vídeo</button>
        </form>
    </div>

    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #6366F1;
            --success-color: #22C55E;
            --error-color: #EF4444;
            --background: #f9fafb;
            --text-color: #1F2937;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --font-size-sm: 14px;
            --font-size-md: 16px;
            --font-size-lg: 24px;
        }

        .video-create-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem;
            background: white;
            box-shadow: var(--shadow);
            border-radius: 12px;
        }

        .form-title {
            font-size: var(--font-size-lg);
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .video-form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .form-control {
            padding: 0.5rem 0.75rem;
            font-size: var(--font-size-md);
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            font-weight: bold;
            font-size: var(--font-size-md);
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .video-create-container {
                margin: 1rem;
                padding: 1rem;
            }

            .form-title {
                font-size: 20px;
            }

            .btn-submit {
                font-size: var(--font-size-sm);
                padding: 0.6rem 0.8rem;
            }

            .form-control {
                font-size: var(--font-size-sm);
            }
        }

        @media (max-width: 480px) {
            .form-group label {
                font-size: 13px;
            }
            .form-title {
                font-size: 18px;
            }
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            margin-bottom: 1rem;
            font-size: var(--font-size-md);
            box-shadow: var(--shadow);
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

    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    flash.classList.add('fade-out');
                    setTimeout(() => {
                        flash.remove();
                    }, 500);
                }, 4000);
            }
        });
    </script>

</x-videos-app-layout>
