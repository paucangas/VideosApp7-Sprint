<x-videos-app-layout>
    <div class="edit-user-wrapper">
        <h1>Afegir Nou Usuari</h1>

        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.manage.store') }}" method="POST">
            @csrf
            <div class="form-field">
                <label for="name">Nom</label>
                <input type="text" name="name" data-qa="input-name" required>
            </div>

            <div class="form-field">
                <label for="email">Correu electrònic</label>
                <input type="email" name="email" data-qa="input-email" required>
            </div>

            <div class="form-field">
                <label for="password">Contrasenya</label>
                <input type="password" name="password" data-qa="input-password" required>
            </div>

            <div class="form-field">
                <label for="role">Rol</label>
                <select name="role" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary">Crear usuari</button>
        </form>
    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .edit-user-wrapper {
            max-width: 480px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border: 1px solid #e3e6ec;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .alert-error {
            background-color: #ffeef0;
            color: #b71c1c;
            padding: 14px 20px;
            border-left: 5px solid #d32f2f;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .form-field {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cfd8dc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 6px rgba(74, 144, 226, 0.3);
            outline: none;
        }

        .btn-primary {
            width: 100%;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            font-size: 16px;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        @media (max-width: 500px) {
            .edit-user-wrapper {
                padding: 25px;
                margin: 40px 15px;
            }

            h1 {
                font-size: 20px;
            }

            .btn-primary {
                font-size: 15px;
            }
        }
    </style>
</x-videos-app-layout>
