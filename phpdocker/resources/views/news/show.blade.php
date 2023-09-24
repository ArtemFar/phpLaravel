@extends('layouts.app')
@section('title') {{ $news->title }} - @parent @stop
@section('content')
    <h2>{{ $news->title }}</h2> <br />
    <div>
        <img src="{{ $news->image }}" />
        <p><em>{{ $news->author }}</em> &nbsp; ({{ $news->created_at }})</p>
        <p>{{ $news->description }}</p>
    </div><hr /><br />
@endsection

