{{--Корневой шаблон с шапкой--}}
    <!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мой интернет магазин</title>
    <link rel="stylesheet" href="/public/assets/css/theme.css">
    <script src = "/public/assets/js/bootstrap.bundle.js"></script>
</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Поликлиника</a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Главная</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="login" class="nav-link">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a href="register" class="nav-link">Регистрация</a>
                    </li>
                @endguest
                @auth
                    @if(Auth::user()->role->EN_name == 'Admin')
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Администрирование</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item dropdown-toggle">Роли</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('admin.roles.create')}}" class="dropdown-item">Создание</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.roles.index')}}" class="dropdown-item">Просмотр</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item dropdown-toggle">Пользователи</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('admin.users.create')}}" class="dropdown-item">Создание</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.users.index')}}" class="dropdown-item">Просмотр</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-item dropdown-toggle">Кабинеты</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('admin.cabinets.create')}}" class="dropdown-item">Создание</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.cabinets.index')}}" class="dropdown-item">Просмотр</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{'logout'}}">Выход</a></li>
                @endauth
            </ul>
        </div>
    </div>
</header>
@yield('content')
</body>
</html>
