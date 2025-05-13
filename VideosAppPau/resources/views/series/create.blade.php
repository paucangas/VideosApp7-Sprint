<x-videos-app-layout>
    <div class="container">
        <h1 class="title">Crear Sèrie</h1>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data" data-qa="create-series-form">
            @csrf

            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required data-qa="input-title">
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea name="description" class="form-control" required data-qa="input-description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Imatge (Opcional)</label>
                <input type="file" name="image" class="form-control" data-qa="input-image">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-create-serie">Crear Sèrie</button>
            </div>
        </form>
    </div>

    <style>
        /* General styles */
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #f7f7f7;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background-color: #fff;
        }

        .btn-create-serie {
            width: 100%;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-create-serie:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        /* Alert styles */
        .alert {
            background-color: #f8d7da;
            border-left: 6px solid #e63946;
            padding: 12px;
            border-radius: 8px;
            color: #e63946;
            font-weight: 600;
        }

        .alert ul {
            padding-left: 20px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .title {
                font-size: 1.5rem;
            }

            .btn-create-serie {
                font-size: 14px;
            }
        }
    </style>
</x-videos-app-layout>
