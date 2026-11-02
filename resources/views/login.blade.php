@extends('layout.index')
@section('main')
<h1>Страница авторизации</h1>
<form action="{{ route('store.login') }}" method="POST">
    @csrf

    <label for="">Введите логин</label><br>
    <input type="text" name="login" required><br>

    <label for="">Введите пароль</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Войти"><br>
</form>
@endsection