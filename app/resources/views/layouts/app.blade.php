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
                <nav class="w3-navbar w3-card-4 w3-theme">
                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                    <li><a href="#"><i class="fa fa-user-md"></i> Сотрудники</a></li>
                    <li><a href="#"><i class="fa fa-bed"></i> Пациенты</a></li>
                    <li class="w3-dropdown-hover">
                        <a href="#"><i class="fa fa-book"></i> Cправочники <i class="fa fa-caret-down"></i></a>
                        <section class="w3-dropdown-content w3-card-4 w3-theme">
                            <a href="#"><i class="fa fa-medkit"></i> Медикаменты</a>
                            <a href="#"><i class="fa fa-briefcase"></i> Должности</a>
                            <a href="contact-types"><i class="fa fa-map-marker"></i> Типы контактов</a>
                        </section>
                    </li>
                    <li class="w3-right"><a href="#"><i class="fa fa-sign-out"></i></a></li>
                    <li class="w3-right"><a href="#"><i class="fa fa-cog"></i> A user name</a></li>
                    <li class="w3-right"><a href="#"><i class="fa fa-money"></i> Баланс: 0 тг</a></li>
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
</html>
