<x-videos-app-layout>
    <div class="container">
        <h1 class="text-center mb-4">Editar Vídeo</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST" data-qa="video-edit-form">
            @csrf
            @method('PUT')

            <!-- Camp de títol -->
            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
            </div>

            <!-- Camp de descripció -->
            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea class="form-control" id="description" name="description">{{ $video->description }}</textarea>
            </div>

            <!-- Camp d'URL -->
            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $video->url }}" required>
            </div>

            <!-- Camp de data de publicació -->
            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>

            <!-- Camp de vídeo anterior -->
            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous" value="{{ $video->previous }}">
            </div>

            <!-- Camp de vídeo següent -->
            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next" value="{{ $video->next }}">
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

            <!-- Botó per actualitzar el vídeo -->
            <button type="submit" class="btn btn-edit-video mt-3">Actualitzar Vídeo</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    flash.remove();
                }, 4000); // 4000ms = 4 segons
            }
        });
    </script>

    <style>
        /* Estils generals */
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 16px;
        }

        .btn-edit-video {
            background-color: #4F46E5;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        .btn-edit-video:hover {
            background-color: #0056b3;
        }

        /* Colors */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
        }

        /* Responsivitat */
        @media (max-width: 768px) {
            h1 {
                font-size: 20px;
            }

            .form-control {
                font-size: 14px;
                padding: 10px;
            }

            .btn-edit-video {
                width: 100%;
            }

            .form-group {
                margin-bottom: 1rem;
            }
        }

        /* Estil per a cards */
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body {
            font-size: 14px;
        }

        /* Ombra per les cards */
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Estil per al navbar en mòbil */
        @media (max-width: 768px) {
            .navbar-collapse {
                background-color: #f8f9fa;
                padding: 10px;
            }

            .navbar-nav {
                flex-direction: column;
                text-align: center;
            }

            .navbar-nav .nav-item {
                margin-bottom: 10px;
            }
        }

        /* Títols com botons */
        .btn-title {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
        }

        .btn-title:hover {
            background-color: #218838;
        }
    </style>
</x-videos-app-layout>
