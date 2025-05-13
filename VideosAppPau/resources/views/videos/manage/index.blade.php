<x-videos-app-layout>
    <div class="container">
        <h1>Gestió de Vídeos</h1>
        <a href="{{ route('videos.manage.create') }}" class="btn btn-create-video mb-3">Crear Vídeo</a>

        <!-- Missatge d'èxit -->
        @if (session('success'))
            <div id="flash-message" class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Missatge d'error -->
        @if (session('error'))
            <div id="flash-message" class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Comencem amb la taula per a pantalles més grans -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3">
                <thead>
                <tr class="table-header">
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>URL</th>
                    <th>Data de publicació</th>
                    <th>Anterior</th>
                    <th>Següent</th>
                    <th>Sèrie</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->title }}</td>
                        <td>{{ \Str::limit($video->description, 50) }}</td>
                        <td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</td>
                        <td>{{ $video->previous }}</td>
                        <td>{{ $video->next }}</td>
                        <td>{{ $video->series_id }}</td>
                        <td>
                            <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estas segur de que vols eliminiar el vídeo?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mode responsive - mostrar vídeos com a llista -->
        <div class="video-list d-block d-md-none">
            @foreach ($videos as $video)
                <div class="video-item">
                    <h3>{{ $video->title }}</h3>
                    <p><strong>Descripció:</strong> {{ \Str::limit($video->description, 100) }}</p>
                    <p><strong>URL:</strong> <a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></p>
                    <p><strong>Data de publicació:</strong> {{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</p>
                    <p><strong>Anterior:</strong> {{ $video->previous }}</p>
                    <p><strong>Següent:</strong> {{ $video->next }}</p>
                    <p><strong>Sèrie:</strong> {{ $video->series_id }}</p>
                    <div class="video-actions">
                        <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estas segur de que vols eliminiar el vídeo?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

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
        /* Estil personalitzat per a l'alerta */
        .alert {
            font-size: 16px;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Estil per als botons de creació i accions */
        .btn-create-video {
            background-color: #4F46E5;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .btn-create-video:hover {
            background-color: #2b3971;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning{
            background-color: #ffc107;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            border: 2px solid #000000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 14px;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f7f7f7;
            color: #333;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e9f5f0;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        /* Afegir color de fons per la capçalera de la taula */
        .table-header th {
            background-color: #4F46E5;
            color: white;
        }

        /* Mode responsive - Estil per a la llista de vídeos */
        .video-list {
            display: none;
        }

        .video-list .video-item {
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .video-list .video-item h3 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
        }

        .video-list .video-item p {
            font-size: 14px;
            color: #555;
        }

        /* Mostrar la llista a dispositius petits */
        @media (max-width: 768px) {
            .video-list {
                display: block;
            }

            .table-responsive {
                display: none;
            }

            .btn-create-video {
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</x-videos-app-layout>
