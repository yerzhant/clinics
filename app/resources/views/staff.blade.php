@extends('layouts.app')

@section('header')
    Cотрудники
@endsection

@section('content')
    <section id="modal" class="w3-modal">
        <section class="w3-modal-content w3-card-8 w3-animate-zoom">
            <header class="w3-container w3-theme">
                <span class="w3-closebtn" onclick="$('#modal').css('display', 'none')">&times;</span>
                <h3>Cотрудник</h3>
            </header>

            <form class="w3-container w3-section" action="staff" method="post">
                {!! csrf_field() !!}

                <input id="id" type="hidden" name="id" value="">

                <section class="w3-container w3-full">
                    <select id="position" class="w3-select" name="position" required>
                        <option value="" disabled selected>Выберите значение</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    <label class="w3-label w3-validate">Должность</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="last_name" type="text" class="w3-input"
                           name="last_name" placeholder="Введите значение" required>
                    <label class="w3-label w3-validate">Фамилия</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="first_name" type="text" class="w3-input"
                           name="first_name" placeholder="Введите значение" required>
                    <label class="w3-label w3-validate">Имя</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="surname" type="text" class="w3-input"
                           name="surname">
                    <label class="w3-label w3-validate">Отчество</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="email" type="email" class="w3-input"
                           name="email" placeholder="Введите значение" required>
                    <label class="w3-label w3-validate">e-mail</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="password" type="password" class="w3-input"
                           name="password">
                    <label class="w3-label w3-validate">Пароль</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="password_confirmation" type="password" class="w3-input"
                           name="password_confirmation">
                    <label class="w3-label w3-validate">Подтверждение</label>
                </section>

                <section class="w3-container w3-padding-hor-8 w3-center w3-rest">
                    <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange"
                            onclick="$('#modal').css('display', 'none')">
                        <i class="fa fa-database"></i> Сохранить
                    </button>

                    <button type="reset" class="w3-btn w3-round w3-ripple w3-theme w3-hover-yellow"
                            onclick="$('#id').val('');$('#modal').css('display', 'none')">
                        <i class="fa fa-ban"></i> Отменить
                    </button>
                </section>
            </form>
        </section>
    </section>

    <section class="w3-row w3-margin-top data">
        <a class="w3-btn-floating w3-theme w3-hover-green"
            onclick="$('#modal').css('display', 'block')">
            <i class="fa fa-plus"></i>
        </a>

        <table class="w3-table w3-striped w3-hoverable">
            <tr class="w3-theme-l2">
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Должность</th>
                <th>e-mail</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach($staff as $s)
                <tr>
                    <td>{{ $s->last_name }}</td>
                    <td>{{ $s->first_name }}</td>
                    <td>{{ $s->surname }}</td>
                    <td>{{ $s->position->name }}</td>
                    <td>{{ $s->user->email }}</td>

                    <td class="command">
                        <a href="/staff/{{ $s->id }}/services" class="w3-btn w3-round w3-ripple w3-theme w3-hover-blue" title="Услуги">
                            <i class="fa fa-stethoscope"></i>
                        </a>
                    </td>

                    <td class="command">
                        <a href="staff/{{ $s->id }}/contacts" class="w3-btn w3-round w3-ripple w3-theme w3-hover-blue" title="Контакты">
                            <i class="fa fa-map-marker"></i>
                        </a>
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $s->id }}');
                                         $('#last_name').val('{{ $s->last_name }}');
                                         $('#first_name').val('{{ $s->first_name }}');
                                         $('#surname').val('{{ $s->surname }}');
                                         $('#position').val('{{ $s->position_id }}');
                                         $('#email').val('{{ $s->user->email }}');
                                         $('#modal').css('display', 'block')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $s->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $s->id }}').css('display', 'none')">&times;</span>
                                    <h3>Предупреждение</h3>
                                </header>

                                <form class="w3-container w3-pale-red" action="/staff/{{ $s->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $s->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
