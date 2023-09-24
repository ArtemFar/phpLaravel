@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    @include('inc.message')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert :message="$error" type="danger"></x-alert>
        @endforeach
    @endif
    <form method="post" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $news->title }}">
        </div>

        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" name="category_id" id="category_id">

                @foreach($categories as $category)

                    {{--          <option value="{{ $category->id }}" @if($category->id == $news->category_id) selected @endif>{{ $category->title }}</option>--}}
                    <option
                        value="{{ $category->id }}" @selected(old('category_id', $news->category_id) == $category->id)>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ old('author') ?? $news->author }}">
        </div>


        <div class="form-group">
            <label for="status">Статус</label>

                <select class="form-control" name="status" id="status">
                    <option @if($news->status === \App\Enums\News\Status::DRAFT->value) selected @endif>{{ \App\Enums\News\Status::DRAFT->value }}</option>
                    <option @if($news->status === \App\Enums\News\Status::ACTIVE->value) selected @endif>{{ \App\Enums\News\Status::ACTIVE->value }}</option>
                    <option @if($news->status === \App\Enums\News\Status::BLOCKED->value) selected @endif>{{ \App\Enums\News\Status::BLOCKED->value }}</option>
                </select>

        </div>


        <div class="form-group">
            <label for="image">Изображение</label>
            <img src="{{ $news->image }}" width="100">
            <input type="file" class="form-control" name="image" id="image">
        </div>


        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') ?? $news->description }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
