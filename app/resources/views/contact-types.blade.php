@extends('layouts.app')

@section('header')
    Типы контактов
@endsection

@section('content')
    <section class="w3-row">
        <form action="contact-type" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">


            <p>
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label">Наименование</label>
            </p>

            <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange">
                <i class="fa fa-database"></i> Сохранить
            </button>

            <button type="reset" class="w3-btn w3-round w3-ripple w3-theme w3-hover-yellow"
                    onclick="$('#id').val('')">
                <i class="fa fa-ban"></i> Отменить
            </button>
        </form>
    </section>

    <section class="w3-row w3-margin-top">
        <table class="w3-table w3-striped w3-hoverable">
            @foreach($contactTypes as $contactType)
                <tr>
                    <td>
                        {{ $contactType->name }}
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $contactType->id }}');
                                         $('#name').val('{{ $contactType->name }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <form action="/contact-type/{{ $contactType->id }}" method="post">
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
