<x-videos-app-layout>
    <div class="container">
        <h1>Editar Vídeo</h1>

        <form action="{{ route('videos.update', $video->id) }}" method="POST" data-qa="video-edit-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea class="form-control" id="description" name="description">{{ $video->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $video->url }}" required>
            </div>

            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous" value="{{ $video->previous }}">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next" value="{{ $video->next }}">
            </div>

            <div class="form-group">
                <label for="series_id">Sèrie</label>
                <select class="form-control" id="series_id" name="series_id">
                    <option value="">Tria una sèrie</option>
                    @foreach ($series as $serie)
                        <option value="{{ $serie->id }}" {{ $serie->id == $video->series_id ? 'selected' : '' }}>
                            {{ $serie->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-edit-video mt-3">Actualitzar Vídeo</button>
        </form>
    </div>

    <style>
        /* Estil general */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #2b6cb0;
            margin-bottom: 1rem;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #d2d6dc;
            background-color: #fafafa;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4c9efb;
            box-shadow: 0 0 8px rgba(72, 116, 248, 0.5);
            outline: none;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-edit-video {
            background-color: #4c9efb;
            color: #ffffff;
            border: none;
        }

        .btn-edit-video:hover {
            background-color: #3182ce;
            transform: translateY(-2px);
        }

        .btn-edit-video:active {
            background-color: #2c6db4;
            transform: translateY(2px);
        }

        /* Responsivitat */
        @media screen and (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .form-group label {
                font-size: 0.875rem;
            }

            .form-control {
                padding: 0.5rem;
            }

            .btn {
                width: 100%;
                padding: 1rem;
            }
        }

        /* Estil de missatges */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
            text-align: center;
            font-weight: bold;
            display: none;
        }

        .alert-success {
            background-color: #38a169;
            color: white;
        }

        .alert-error {
            background-color: #e53e3e;
            color: white;
        }

        /* Card estil */
        .card {
            padding: 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            transition: transform 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 1rem;
        }

        /* Estils per menús desplegables */
        .select-dropdown {
            position: relative;
        }

        .select-dropdown select {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #ddd;
            background-color: #fafafa;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .select-dropdown select:focus {
            border-color: #4c9efb;
            box-shadow: 0 0 8px rgba(72, 116, 248, 0.5);
        }

    </style>
</x-videos-app-layout>
