@extends('layouts.admin')
@section('content')
    <h1 class="h2">Редактировать Новость</h1>
    @include('inc.message')
    <form method="POST" action="{{ route('admin.news.update', $news) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="add-news-form-title">Заголовок</label>
            <input type="text" name="title" class="form-control" id="add-news-form-title" placeholder="Заголовок"
                   value="{{ old('title') ?? $news->title }}">
            <label for="add-news-form-url">Слаг Url</label>
            <input type="text" name="url" class="form-control" id="add-news-form-url" placeholder="Url"
                   value="@if(old('url')) {{ old('url') }}@else {{ $news->url_slug }} @endif">
            <label for="add-news-form-author">Автор</label>
            <input type="text" name="author" class="form-control" id="add-news-form-author" placeholder="Автор"
                   value="{{ old('author') ?? $news->author }}">
        </div>
        <div class="form-group">
            <label for="add-news-form-state">Статус</label>
            <select class="form-control" id="add-news-form-state" name="status">
                <option @selected(old('status', $news->status) == \App\Enums\News\Status::BLOCKED->value)>draft</option>
                <option @selected(old('status', $news->status) == \App\Enums\News\Status::BLOCKED->value)>active</option>
                <option @selected(old('status', $news->status) == \App\Enums\News\Status::BLOCKED->value)>blocked</option>
            </select>
        </div>
        <div class="form-group">
            <label for="add-news-form-category">Категория</label>
            <select class="form-control" id="add-news-form-category" name="category_id">
                @forelse($categories as $category)
                    <option value="{{$category->id}}" @selected(old('category_id', $news->categiry_id) == $category->id)>{{$category->title}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="add-news-form-description">Описание</label>
            <textarea name="description" class="form-control" id="add-news-form-description"
                      rows="3">{{ old('description') ?? $news->description }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2 mt-2">Сохранить</button>
        </div>
    </form>
@endsection
