<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Клиника</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/w3.css">
        <link rel="stylesheet" href="/css/theme.css">
        <link rel="stylesheet" href="/css/main.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <section class="w3-top">
                <nav class="w3-navbar w3-card-4 w3-theme-d2">
                    <li class="w3-opennav w3-hide-medium w3-hide-large">
                            <a href="#"><i class="fa fa-bars"></i></a>
                    </li>

                    <li class="w3-opennav"><a href="#"><i class="fa fa-home"></i></a></li>

                    <li class="w3-hide-small"><a href="#"><i class="fa fa-user-md"></i> Сотрудники</a></li>

                    <li class="w3-hide-small"><a href="#"><i class="fa fa-bed"></i> Пациенты</a></li>

                    <li class="w3-dropdown-hover w3-hide-small">
                        <a href="#"><i class="fa fa-book"></i> Cправочники <i class="fa fa-caret-down"></i></a>
                        <section class="w3-dropdown-content w3-card-4 w3-theme-d2">
                            <a href="medicines"><i class="fa fa-medkit"></i> Медикаменты</a>
                            <a href="#"><i class="fa fa-briefcase"></i> Должности</a>
                            <a href="contact-types"><i class="fa fa-map-marker"></i> Типы контактов</a>
                        </section>
                    </li>

                    <li class="w3-right w3-opennav"><a href="#" title="Выход"><i class="fa fa-sign-out"></i></a></li>

                    <li class="w3-right w3-opennav"><a href="#" title="Профиль"><i class="fa fa-cog"></i>
                        <span class="w3-hide-small"> A user name</span></a>
                    </li>

                    <li class="w3-right w3-opennav"><a href="#" title="Баланс: 0 тг"><i class="fa fa-money"></i>
                        <span class="w3-hide-small"> 0 тг</span></a>
                    </li>
                </nav>
            </section>
        </header>

        <main class="w3-padding">
            <section class="w3-card-4 w3-round-large">
                <header class="w3-container w3-theme">
                    <h4>@yield('header')</h4>
                </header>

                @include('common.errors')

                <section class="w3-padding">
                    @yield('content')
                </section>
            </section>
        </main>

        <footer class="w3-container">&copy; {{ date('Y') }} v.{{ env('app.version') }}</footer>
    </body>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
</html>
