<x-videos-app-layout>
    <div class="container">
        <h1>Gestió de Sèries</h1>

        <a href="{{ route('series.manage.create') }}" class="btn btn-create-series mb-3" data-qa="create-series">Crear Sèrie</a>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
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
        .container {
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .btn-create-series {
            background-color: #2D9CDB;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 30px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-create-series:hover {
            background-color: #2196f3;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .alert {
            font-size: 16px;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 10px;
            margin-top: 20px;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            color: #333;
        }

        .table th {
            background-color: #2D9CDB;
            color: white;
            font-weight: 700;
            text-align: center;
            padding: 15px;
            letter-spacing: 1px;
        }

        .table td {
            padding: 15px 20px;
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f7f7f7;
        }

        .btn-warning, .btn-danger {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-warning {
            background-color: #fb8c00;
            color: white;
        }

        .btn-warning:hover {
            background-color: #ffc674;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #e12727;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #ef5350;
            transform: translateY(-2px);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 12px;
            }

            .btn-create-series, .btn-warning, .btn-danger {
                font-size: 12px;
                padding: 8px 16px;
            }
        }
    </style>
</x-videos-app-layout>
