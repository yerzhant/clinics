@extends('layouts.app')

@section('header')
    Услуги

    <a href="/staff" class="w3-btn-floating w3-ripple w3-theme-l2 w3-hover-blue header-down-btn-1">
        <i class="fa fa-arrow-left"></i> Назад
    </a>
@endsection

@section('content')
    <section class="w3-row">
        <form action="service" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <section class="w3-container w3-half">
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Наименование</label>
            </section>

            <section class="w3-container w3-half">
                <input id="price" type="text" class="w3-input"
                       name="price">
                <label class="w3-label">Цена</label>
            </section>

            <section class="w3-container">
                <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange">
                    <i class="fa fa-database"></i> Сохранить
                </button>

                <button type="reset" class="w3-btn w3-round w3-ripple w3-theme w3-hover-yellow"
                        onclick="$('#id').val('')">
                    <i class="fa fa-ban"></i> Отменить
                </button>
            </section>
        </form>
    </section>

    <section class="w3-row">
        <h5>{{ $staff->last_name }} {{ $staff->first_name }} {{ $staff->surname }}</h5>
        <table class="w3-table w3-striped w3-hoverable">
            <tr class="w3-theme-l2">
                <th>Наименование</th>
                <th>Цена</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->price }}</td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $service->id }}');
                                         $('#name').val('{{ $service->name }}');
                                         $('#price').val('{{ $service->price }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $service->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-round-large w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $service->id }}').css('display', 'none')">&times;</span>
                                    <h6>Предупреждение</h6>
                                </header>

                                <form class="w3-container w3-round-large w3-pale-red" action="/service/{{ $service->id }}" method="post">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}

                                    Удалить данные?

                                    <button type="submit" class="w3-btn w3-right w3-section w3-round w3-ripple w3-theme w3-hover-deep-orange">
                                        <i class="fa fa-trash"> Удалить</i>
                                    </button>
                                </form>
                            </section>
                        </section>

                        <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange" title="Удалить"
                                onclick="$('#deleteModal{{ $service->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
