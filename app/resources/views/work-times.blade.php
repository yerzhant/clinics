@extends('layouts.app')

@section('header')
    Рабочее время
@endsection

@section('content')
    <section class="w3-row">
        <form action="work-time" method="post">
            {!! csrf_field() !!}

            <input id="id" type="hidden" name="id" value="">

            <section class="w3-container w3-quarter">
                <select id="day" class="w3-select" name="day" required>
                    <option value="" disabled selected>Выберите значение</option>
                    <option value="1">Пн</option>
                    <option value="2">Вт</option>
                    <option value="3">Ср</option>
                    <option value="4">Чт</option>
                    <option value="5">Пт</option>
                    <option value="6">Сб</option>
                    <option value="7">Вс</option>
                </select>
                <label class="w3-label w3-validate">Тип</label>
            </section>

            <section class="w3-container w3-quarter">
                <input id="from_time" type="text" class="w3-input" name="from_time"
                       pattern="\d{1,2}:\d{1,2}" title="чч:мм">
                <label class="w3-label w3-validate">С</label>
            </section>

            <section class="w3-container w3-quarter">
                <input id="to_time" type="text" class="w3-input" name="to_time"
                       pattern="\d{1,2}:\d{1,2}" title="чч:мм">
                <label class="w3-label w3-validate">До</label>
            </section>

            <section class="w3-container w3-quarter">
                <button type="submit" class="w3-btn w3-round w3-ripple w3-theme w3-hover-deep-orange">
                    <i class="fa fa-database"></i> Сохранить
                </button>

                <button type="reset" class="w3-btn w3-round w3-ripple w3-theme w3-hover-yellow"
                        onclick="$('#id').val('')">
                    <i class="fa fa-ban"></i> Отменить
                </button>

                <a href="/staff" class="w3-btn w3-round w3-ripple w3-theme w3-hover-blue">
                    <i class="fa fa-arrow-left"></i> Назад
                </a>
            </section>
        </form>
    </section>

    <section class="w3-row">
        <h3>{{ $staff->last_name }} {{ $staff->first_name }} {{ $staff->surname }}</h3>
        <table class="w3-table w3-striped w3-hoverable">
            <tr class="w3-theme-l2">
                <th>День недели</th>
                <th>С</th>
                <th>До</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($workTimes as $workTime)
                <tr>
                    <td>{{ $workTime->day_string }}</td>
                    <td>{{ $workTime->from_time }}</td>
                    <td>{{ $workTime->to_time }}</td>

                    <td class="command">
                        <button class="w3-btn w3-round w3-ripple w3-theme w3-hover-green" title="Изменить"
                                onclick="$('#id').val('{{ $workTime->id }}');
                                         $('#day').val('{{ $workTime->day }}');
                                         $('#from_time').val('{{ $workTime->from_time }}');
                                         $('#to_time').val('{{ $workTime->to_time }}')">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </td>

                    <td class="command">
                        <section id="deleteModal{{ $workTime->id }}" class="w3-modal">
                            <section class="w3-modal-content w3-card-8 w3-round-large w3-animate-zoom">
                                <header class="w3-container w3-theme">
                                    <span class="w3-closebtn" onclick="$('#deleteModal{{ $workTime->id }}').css('display', 'none')">&times;</span>
                                    <h6>Предупреждение</h6>
                                </header>

                                <form class="w3-container w3-round-large w3-pale-red" action="/work-time/{{ $workTime->id }}" method="post">
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
                                onclick="$('#deleteModal{{ $workTime->id }}').css('display', 'block')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
