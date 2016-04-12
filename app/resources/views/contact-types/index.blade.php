@extends('layouts.app')

@section('header')
    Типы контактов
@endsection

@section('content')
    <section class="w3-row">
        <form action="contact-type" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">
            <input id="name" type="text" class="w3-input w3-twothird w3-margin-bottom w3-margin-right"
                   name="name" placeholder="Тип контакта" required>

            <button type="submit" class="w3-btn w3-margin-bottom w3-round w3-ripple w3-theme w3-hover-deep-orange">
                <i class="fa fa-database"></i> Сохранить
            </button>

            <button type="reset" class="w3-btn w3-margin-bottom w3-round w3-ripple w3-theme w3-hover-yellow"
                    onclick="$('#id').val('')">
                <i class="fa fa-ban"></i> Отменить
            </button>
        </form>
    </section>

    <section class="w3-row">
        <table class="w3-table w3-striped w3-hoverable">
            @foreach($contactTypes as $contactType)
                <tr>
                    <td>
                        {{ $contactType->name }}
                    </td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green"
                                onclick="$('#name').val('{{ $contactType->name }}');$('#id').val('{{ $contactType->id }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <form action="/contact-type/{{ $contactType->id }}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
