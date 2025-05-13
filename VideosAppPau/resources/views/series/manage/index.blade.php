<x-videos-app-layout>
    <div class="container">
        <h1>Gestió de Sèries</h1>

        <a href="{{ route('series.manage.create') }}" class="btn btn-create-series mb-3" data-qa="create-series">Crear Sèrie</a>

        @if(session('success'))
            <div class="alert alert-success mt-3" id="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3" id="alert-error">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>Data de Publicació</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td>{{ $serie->id }}</td>
                        <td>{{ $serie->title }}</td>
                        <td>{{ \Str::limit($serie->description, 50) }}</td>
                        <td>{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d-m-Y') : 'No publicat' }}</td>
                        <td>
                            <a href="{{ route('series.manage.edit', $serie) }}" class="btn btn-warning btn-sm" data-qa="edit-series-{{ $serie->id }}">Editar</a>

                            <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" style="display:inline;" data-qa="delete-series-{{ $serie->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquesta sèrie? Els vídeos associats també seran desassignats.')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn-create-series {
            background-color: #4e73df;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 50px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-create-series:hover {
            background-color: #1c4bd8;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .alert {
            font-size: 16px;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            color: #333;
            overflow: hidden;
        }

        .table th {
            background-color: #4e73df;
            color: white;
            font-weight: 700;
            text-align: center;
            padding: 12px;
            letter-spacing: 1px;
        }

        .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border-top: 1px solid #e0e0e0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .btn-warning, .btn-danger {
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-warning {
            background-color: #ff9800;
            border: 2px solid #000000;
            color: white;
        }

        .btn-warning:hover {
            background-color: #ffb74d;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }

        .btn-danger:hover {
            background-color: #e57373;
            transform: translateY(-2px);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }

            .btn-create-series, .btn-warning, .btn-danger {
                font-size: 14px;
                padding: 10px 18px;
            }

            .table {
                font-size: 12px;
            }

            .table th, .table td {
                padding: 10px;
            }
        }
    </style>


    <script>
        // Funció per fer desaparèixer les alertes després de 4 segons
        setTimeout(function() {
            let successAlert = document.getElementById('alert-success');
            let errorAlert = document.getElementById('alert-error');

            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500); // Esperem que l'animació acabi abans de desaparèixer
            }

            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 500);
            }
        }, 4000); // 4 segons
    </script>
</x-videos-app-layout>
