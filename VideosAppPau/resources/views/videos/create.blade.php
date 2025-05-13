<x-videos-app-layout>
    <div class="video-form-container">
        <h1 class="form-title">🎥 Crear Vídeo</h1>

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('videos.store') }}" method="POST" data-qa="video-create-form">
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

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" id="previous" name="previous">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" id="next" name="next">
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

            <button type="submit" class="btn-primary">Crear Vídeo</button>
        </form>
    </div>

    <style>
        :root {
            --color-primary: #4f46e5;
            --color-primary-hover: #4338ca;
            --color-danger: #dc2626;
            --color-success: #16a34a;
            --color-bg: #f9fafb;
            --color-text: #1f2937;
            --font-family: 'Segoe UI', sans-serif;
        }

        .video-form-container {
            max-width: 700px;
            margin: 3rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            font-family: var(--font-family);
        }

        .form-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--color-primary);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            color: var(--color-text);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f3f4f6;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--color-primary);
            background-color: #fff;
        }

        .btn-primary {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.75rem;
            font-size: 1.1rem;
            font-weight: 700;
            background-color: var(--color-primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--color-primary-hover);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .alert.success {
            background-color: #dcfce7;
            color: var(--color-success);
            border: 1px solid var(--color-success);
        }

        .alert.error {
            background-color: #fee2e2;
            color: var(--color-danger);
            border: 1px solid var(--color-danger);
        }

        @media (max-width: 600px) {
            .form-title {
                font-size: 1.5rem;
            }

            .btn-primary {
                font-size: 1rem;
            }
        }
    </style>
</x-videos-app-layout>
