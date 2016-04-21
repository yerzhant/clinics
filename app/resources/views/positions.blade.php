@extends('layouts.app')

@section('header')
    Должности
@endsection

@section('content')
    <section class="w3-row">
        <form action="position" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <p class="w3-container">
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Наименование</label>
            </p>

            <p class="w3-container">
                <input id="admin" type="checkbox" class="w3-check" name="admin">
                <label class="w3-validate">Администратор</label>

            <p class="w3-container">
                <input id="doctor" type="checkbox" class="w3-check" name="doctor">
                <label class="w3-validate">Врач</label>

            <p class="w3-container">
                <input id="accountant" type="checkbox" class="w3-check" name="accountant">
                <label class="w3-validate">Бухгалтер</label>

            <p class="w3-container">
                <input id="receptionist" type="checkbox" class="w3-check" name="receptionist">
                <label class="w3-validate">Рисепшенист</label>
            </p>

            <p class="w3-container">
                <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange">
                    <i class="fa fa-database"></i> Сохранить
                </button>

                <button type="reset" class="w3-btn w3-round w3-ripple w3-theme w3-hover-yellow"
                        onclick="$('#id').val('')">
                    <i class="fa fa-ban"></i> Отменить
                </button>

            </p>
        </form>
    </section>

    <section class="w3-row w3-margin-top">
        <table class="w3-table w3-striped w3-hoverable">
            <tr>
                <th>
                    Наименование
                </th>
                <th>
                    Роли
                </th>
                <th>

                </th>
                <th>

                </th>
            </tr>
            @foreach($positions as $position)
                <tr>
                    <td>
                        {{ $position->name }}
                    </td>

                    <td>
                        {{ $position->roles_as_string }}
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $position->id }}');
                                         $('#name').val('{{ $position->name }}');
                                         $('#price').val('{{ $position->price }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <form action="/medicine/{{ $position->id }}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange" title="Удалить">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
