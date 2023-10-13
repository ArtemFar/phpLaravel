@extends('layouts.admin')
@section('content')
    <h1 class="h2">Редактировать Пользователя</h1>
    @include('inc.message')
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="edit-user-form-name">Имя Пользователя</label>
            <input type="text" name="name" class="form-control" id="edit-user-form-name" placeholder="Имя пользователя"
                   value="{{ old('name') ?? $user->name }}">
            <label for="edit-user-form-email">Электронная почта</label>
            <input type="text" name="email" class="form-control" id="edit-user-form-email" placeholder="Уьфшд"
                   value="@if(old('email')) {{ old('email') }}@else {{ $user->email }} @endif">
        </div>
        <div class="form-group">
            <label for="edit-user-form-admin">Администратор</label>
            <input name="is_admin" id="edit-user-form-admin" type="checkbox" {{$user->is_admin ? 'checked' : null}}>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2 mt-2">Сохранить</button>
        </div>
    </form>
@endsection
