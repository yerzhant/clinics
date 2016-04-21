@extends('layouts.app')

@section('header')
    Медикаменты
@endsection

@section('content')
    <section class="w3-row">
        <form action="medicine" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <p class="w3-container w3-half">
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Наименование</label>
            </p>

            <p class="w3-container w3-half">
                <input id="price" type="text" class="w3-input"
                       name="price">
                <label class="w3-label">Цена</label>
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
                    Цена
                </th>
                <th>

                </th>
                <th>

                </th>
            </tr>
            @foreach($medicines as $medicine)
                <tr>
                    <td>
                        {{ $medicine->name }}
                    </td>

                    <td>
                        {{ $medicine->price }}
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $medicine->id }}');
                                         $('#name').val('{{ $medicine->name }}');
                                         $('#price').val('{{ $medicine->price }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <form action="/medicine/{{ $medicine->id }}" method="post">
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
