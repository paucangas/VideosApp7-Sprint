<x-videos-app-layout>
    <div class="edit-container">
        <div class="edit-card">
            <h1 class="edit-title">Editar Vídeo</h1>

            <form action="{{ route('videos.update', $video->id) }}" method="POST" data-qa="video-edit-form" class="edit-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Títol</label>
                    <input type="text" id="title" name="title" value="{{ $video->title }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripció</label>
                    <textarea id="description" name="description" rows="4">{{ $video->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" value="{{ $video->url }}" required>
                </div>

                <div class="form-group">
                    <label for="published_at">Data de publicació</label>
                    <input type="date" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="previous">Vídeo anterior</label>
                        <input type="text" id="previous" name="previous" value="{{ $video->previous }}">
                    </div>

                    <div class="form-group">
                        <label for="next">Vídeo següent</label>
                        <input type="text" id="next" name="next" value="{{ $video->next }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="series_id">Sèrie</label>
                    <select id="series_id" name="series_id">
                        <option value="">Tria una sèrie</option>
                        @foreach ($series as $serie)
                            <option value="{{ $serie->id }}" {{ $serie->id == $video->series_id ? 'selected' : '' }}>
                                {{ $serie->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-update">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Actualitzar Vídeo
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

        .edit-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .edit-card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .edit-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
        }

        .edit-form {
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

        .btn-update {
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

        .btn-update:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        @media (max-width: 768px) {
            .edit-card {
                padding: 1.5rem;
            }

            .edit-title {
                font-size: 1.75rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .edit-title {
                font-size: 1.5rem;
            }
        }
    </style>
</x-videos-app-layout>
