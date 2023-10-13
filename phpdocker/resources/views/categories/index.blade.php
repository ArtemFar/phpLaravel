@extends('layouts.main')
@section('content')
    <h1>News Categories</h1>
    @forelse($categories as $category)
        <a href="{{route('categories.show', ['id' => $category->id])}}" class="btn btn-primary btn-lg px-4 gap-3 mb-2">{{$category->name}} </a>
    @empty
        <h2>Новостей нет</h2>
    @endforelse
@endsection
