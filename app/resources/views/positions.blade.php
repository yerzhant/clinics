@extends('layouts.app')

@section('header')
    Должности
@endsection

@section('content')
    <section class="w3-row">
        <form action="position" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <section class="w3-container w3-half">
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Наименование</label>
            </section>

            <section class="w3-container checkboxes">
                <div class="w3-padding-right">
                    <input id="admin" type="checkbox" class="w3-check" name="admin">
                    <label for="admin" class="w3-validate">Администратор</label>
                </div>

                <div class="w3-padding-right">
                    <input id="doctor" type="checkbox" class="w3-check" name="doctor">
                    <label for="doctor" class="w3-validate">Врач</label>
                </div>

                <div class="w3-padding-right">
                    <input id="accountant" type="checkbox" class="w3-check" name="accountant">
                    <label for="accountant" class="w3-validate">Бухгалтер</label>
                </div>

                <div class="w3-padding-right">
                    <input id="receptionist" type="checkbox" class="w3-check" name="receptionist">
                    <label for="receptionist" class="w3-validate">Рисепшнист</label>
                </div>
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

    <section class="w3-row w3-margin-top">
        <table class="w3-table w3-striped w3-hoverable">
            <tr class="w3-theme-l2">
                <th>Наименование</th>
                <th>Роли</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td>{{ $position->roles_as_string }}</td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $position->id }}');
                                         $('#name').val('{{ $position->name }}');
                                         $('#admin').prop('checked', {{ $position->is_admin }});
                                         $('#doctor').prop('checked', {{ $position->is_doctor }});
                                         $('#accountant').prop('checked', {{ $position->is_accountant }});
                                         $('#receptionist').prop('checked', {{ $position->is_receptionist }})">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $position->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-round-large w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $position->id }}').css('display', 'none')">&times;</span>
                                    <h6>Предупреждение</h6>
                                </header>

                                <form class="w3-container w3-round-large w3-pale-red" action="/position/{{ $position->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $position->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
