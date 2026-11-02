@extends('layout.index')
@section('main')
<h1>Страница регистрации</h1>
<form action="{{ route('store.createApp') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="">Выберите изображение</label><br>
    <input type="file" name="image" accept="image/*"><br>

    <label for="">Название статьи</label><br>
    <input type="text" name="title" required><br>

    <label for="">Описание статьи</label><br>
    <input type="text" name="description" required><br>

    <input type="submit" value="Создать"><br>
</form>
@endsection