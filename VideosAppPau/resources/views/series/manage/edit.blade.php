<x-videos-app-layout>
    <div class="container">
        <h1>Editar Sèrie: {{ $serie->title }}</h1>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('series.manage.update', $serie) }}" method="POST" data-qa="edit-series-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $serie->title) }}" required data-qa="input-title">
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea name="description" class="form-control" required data-qa="input-description">{{ old('description', $serie->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Imatge (Opcional)</label>
                <input type="file" name="image" class="form-control" data-qa="input-image">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-submit">Actualizar Sèrie</button>
            </div>
        </form>
    </div>

    <style>
        /* Estils generals */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Títol de la pàgina */
        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #333333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Alertes d'error */
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
        }

        /* Formulario */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            font-size: 16px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 100%;
            box-sizing: border-box;
            background-color: #f8f8f8;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        /* Botó */
        .btn-submit {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</x-videos-app-layout>
