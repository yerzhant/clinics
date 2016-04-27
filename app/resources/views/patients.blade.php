@extends('layouts.app')

@section('header')
    Пациенты
@endsection

@section('content')
    <section id="modal" class="w3-modal">
        <section class="w3-modal-content w3-card-8 w3-animate-zoom">
            <header class="w3-container w3-theme">
                <span class="w3-closebtn" onclick="$('#modal').css('display', 'none')">&times;</span>
                <h3>Пациент</h3>
            </header>

            <form class="w3-container" action="patient" method="post">
                {!! csrf_field() !!}

                <input id="id" type="hidden" name="id" value="">

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
                    <input id="birth_date" type="date" class="w3-input"
                           name="birth_date" placeholder="Введите значение"
                           pattern="\d{1,2}\.\d{1,2}\.\d{4}" title="дд.мм.гггг" required>
                    <label class="w3-label w3-validate">Дата рождения</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="doc_type_id" type="radio" class="w3-radio"
                           name="doc_type" value="id">
                    <label class="w3-label w3-validate">Уд/л</label>
                    <input id="doc_type_passport" type="radio" class="w3-radio"
                           name="doc_type" value="passport">
                    <label class="w3-label w3-validate">Паспорт</label>
                </section>

                <section class="w3-container w3-third">
                    <input id="doc_number" type="text" class="w3-input"
                           name="doc_number">
                    <label class="w3-label w3-validate">№ документа</label>
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
                <th>Дата рождения</th>
                <th>Вид документа</th>
                <th>№ документа</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->last_name }}</td>
                    <td>{{ $patient->first_name }}</td>
                    <td>{{ $patient->surname }}</td>
                    <td>{{ $patient->birth_date }}</td>
                    <td>{{ $patient->doc_type }}</td>
                    <td>{{ $patient->doc_number }}</td>

                    <td class="command">
                        <a href="patient/{{ $patient->id }}/contacts" class="w3-btn w3-round w3-ripple w3-theme w3-hover-blue" title="Контакты">
                            <i class="fa fa-map-marker"></i>
                        </a>
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $patient->id }}');
                                         $('#last_name').val('{{ $patient->last_name }}');
                                         $('#first_name').val('{{ $patient->first_name }}');
                                         $('#surname').val('{{ $patient->surname }}');
                                         $('#birth_date').val('{{ $patient->birth_date }}');
                                         $('#doc_type_id').prop('checked', {{ $patient->doc_type === "Уд/л" ? 'true' : 'false' }});
                                         $('#doc_type_passport').prop('checked', {{ $patient->doc_type === "Паспорт" ? 'true' : 'false' }});
                                         $('#doc_number').val('{{ $patient->doc_number }}');
                                         $('#modal').css('display', 'block')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $patient->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $patient->id }}').css('display', 'none')">&times;</span>
                                    <h3>Предупреждение</h3>
                                </header>

                                <form class="w3-container w3-pale-red" action="/medicine/{{ $patient->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $patient->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
