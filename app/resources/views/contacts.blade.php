@extends('layouts.app')

@section('header')
    Контакты

    <a href="{{ session()->get('prev-path') }}"
        class="w3-btn-floating w3-ripple w3-theme-l2 w3-hover-blue header-down-btn-1">
        <i class="fa fa-arrow-left"></i> Назад
    </a>
@endsection

@section('content')
    <section class="w3-row">
        <form action="contact" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <section class="w3-container w3-half">
                <select id="contactType" class="w3-select" name="contactType" required>
                    <option value="" disabled selected>Выберите значение</option>
                    @foreach($contactTypes as $contactType)
                        <option value="{{ $contactType->id }}">{{ $contactType->name }}</option>
                    @endforeach
                </select>
                <label class="w3-label w3-validate">Тип</label>
            </section>

            <section class="w3-container w3-half">
                <input id="value" type="text" class="w3-input"
                       name="value" placeholder="Введите значение" required>
                <label class="w3-label w3-validate">Значение</label>
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
        <h5>{{ $entity->last_name }} {{ $entity->first_name }} {{ $entity->surname }}</h5>
        <table class="w3-table w3-striped w3-hoverable">
            <tr class="w3-theme-l2">
                <th>Тип</th>
                <th>Значение</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->contactType->name }}</td>
                    <td>{{ $contact->value }}</td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $contact->id }}');
                                         $('#contactType').val('{{ $contact->contact_type_id }}');
                                         $('#value').val('{{ $contact->value }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $contact->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-round-large w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $contact->id }}').css('display', 'none')">&times;</span>
                                    <h6>Предупреждение</h6>
                                </header>

                                <form class="w3-container w3-round-large w3-pale-red" action="/contact/{{ $contact->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $contact->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
