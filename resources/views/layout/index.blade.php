<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        header{
            display: flex;
            justify-content: space-between;
        }

        header ul{
            display: flex;
            gap: 20px;
            list-style-type: none;
        }
    </style>
</head>
<body>
    <header>
        <h2>header</h2>
        <ul>
            @guest
                <li><a href="{{ route('show.register') }}">Регистрация</a></li>
                <li><a href="{{ route('show.login') }}">Авторизация</a></li>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit"  value="Выход">
                </form>
            @endauth
                
        </ul>
    </header>

    <main>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('main')
    </main>

    <footer>
        <h2>footer</h2>
    </footer>
</body>
</html>