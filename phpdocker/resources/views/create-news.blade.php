@extends('layouts.admin')
@section('content')
    <h1 class="h2">Создать новость</h1>
{{--    @if($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            <x-alert :message="$error" type="danger"></x-alert>--}}
{{--        @endforeach--}}
{{--    @endif--}}
    @include('inc.message')
    <form method="POST" action="{{ route('admin.news.store') }}">
        @csrf
        <div class="form-group">
            <label for="add-news-form-title">Заголовок</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="add-news-form-title" placeholder="Заголовок"
                   value="{{ old('title') }}">
            @error('title')
            <div id="validationServerTitleFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <label for="add-news-form-url">Слаг Url</label>
            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="add-news-form-url" placeholder="Url"
                   value="@if(old('url')) {{ old('url') }}@else {{ fake()->slug() }} @endif">
            @error('url')
            <div id="validationServerUrlFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <label for="add-news-form-author">Автор</label>
            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="add-news-form-author" placeholder="Автор"
                   value="{{ old('author') }}">
            @error('author')
            <div id="validationServerAuthorFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="add-news-form-state">Статус</label>
            <select class="form-control @error('status') is-invalid @enderror" id="add-news-form-state" name="status">
                <option @selected(old('status') == 'draft')>draft</option>
                <option @selected(old('status') == 'active')>active</option>
                <option @selected(old('status') == 'blocked')>blocked</option>
            </select>
            @error('status')
            <div id="validationServerStatusFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="add-news-form-category">Категория</label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="add-news-form-category" name="category_id">
                @forelse($categories as $category)
                    <option value="{{$category->id}}" @selected(old('category_id') == $category->id)>{{$category->title}}</option>
                @empty
                @endforelse
            </select>
            @error('category_id')
            <div id="validationServerCategoryFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="add-news-form-description">Описание</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="add-news-form-description"
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
