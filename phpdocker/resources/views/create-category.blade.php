@extends('layouts.admin')
@section('content')
    <h1 class="h2">Создать категорию</h1>
    @include('inc.message')
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="add-category-form-title">Заголовок</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="add-category-form-title" placeholder="Заголовок"
                   value="{{ old('title') }}">
            @error('title')
            <div id="validationServerTetleFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <label for="add-category-form-url">Слаг Url</label>
            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="add-category-form-url" placeholder="Url"
                   value="@if(old('url')) {{ old('url') }}@else {{ fake()->slug() }} @endif">
            @error('url')
            <div id="validationServerUrlFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="add-category-form-description">Описание</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="add-category-form-description"
                      rows="3">{{ old('description') }}</textarea>
            @error('description')
            <div id="validationServerDescriptionFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2 mt-2">Создать</button>
        </div>
    </form>
@endsection
