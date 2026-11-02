@extends('layout.index')
@section('main')
<h1>Пользователь</h1>
<img src="{{ asset('storage/'. Auth()->user()->avatar) }}" alt="{{ Auth()->user()->full_name }}" width="120px" height="120px"><br>
<a href="{{ route('show.createApp') }}">Создать заявку</a>

<h2>Мои заявки:</h2>

<form action="{{ route('show.user') }}" method="GET">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по названию...">


    <select name="status">
        <option value="">Все статусы</option>
        <option value="На модерации"{{ request('status')=='На модерации' ? 'selected' : '' }}>На модерации</option>
        <option value="Опубликовано"{{ request('status')=='Опубликовано' ? 'selected' : '' }}>Опубликовано</option></option>
        <option value="Отклонено"{{ request('status')=='Отклонено' ? 'selected' : '' }}>Отклонено</option></option>
    </select>

    <button type="submit">Найти</button>

    <a href="{{ route('show.user')}}">Сбросить</a>

</form>

@if ($applications->isEmpty())
    <p>У вас пока нет заявок.</p>
@else
    @foreach ($applications as $application)
            <p>
                <strong>Название:</strong>
                {{ $application->title }}
            </p>

            <p>
                <strong>Описание:</strong>
                {{ $application->description }}
            </p>

            <p>
                <strong>Статус:</strong>
                {{ $application->status }}
            </p>

            @if ($application->image)

                <img src="{{ asset('storage/' . $application->image) }}" alt="{{ $application->title }}" width="200">

            @endif

    @endforeach

@endif


@endsection