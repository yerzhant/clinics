@extends('layouts.app')

@section('header')
    Типы контактов
@endsection

@section('content')
    <form action="contact-type" method="post">
        {!! csrf_field() !!}

        <input type="text" class="w3-input w3-half" name="name" placeholder="Тип контакта">
        <button type="submit" class="w3-btn w3-round w3-ripple w3-margin-left w3-deep-orange"><i class="fa fa-database"></i> Сохранить</button>
    </form>
@endsection
