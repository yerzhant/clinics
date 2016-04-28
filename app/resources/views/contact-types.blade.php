@extends('layouts.app')

@section('header')
    Типы контактов
@endsection

@section('content')
    <section class="w3-row">
        <form action="contact-type" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <section class="w3-container">
                <input id="name" type="text" class="w3-input"
                       name="name" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Наименование</label>
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
            @foreach($contactTypes as $contactType)
                <tr>
                    <td>{{ $contactType->name }}</td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $contactType->id }}');
                                         $('#name').val('{{ $contactType->name }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $contactType->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-round-large w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $contactType->id }}').css('display', 'none')">&times;</span>
                                    <h6>Предупреждение</h6>
                                </header>

                                <form class="w3-container w3-round-large w3-pale-red" action="/contact-type/{{ $contactType->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $contactType->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
