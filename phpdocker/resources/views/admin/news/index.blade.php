@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.news.create') }}">Добавить новость</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">



        @include('inc.message')
        <select id="filter">
            <option>selected</option>
            <option>{{ \App\Enums\News\Status::DRAFT->value }}</option>
            <option>{{ \App\Enums\News\Status::ACTIVE->value }}</option>
            <option>{{ \App\Enums\News\Status::BLOCKED->value }}</option>
        </select>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Категория</th>
                <th scope="col">Автор</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            @forelse($newsList as $news)
                <tr id="{{ $news->id }}">
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->category->title }}</td>
                    <td>{{ $news->author }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->created_at }}</td>
                    <td><a href="{{ route('admin.news.edit', $news) }}">Edit</a> &nbsp; <a rel="{{ $news->id }}" class="delete" href="javascript:">Delete</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Записей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let filter = document.getElementById("filter");
            filter.addEventListener("change", function (event) {
                location.href = "?f=" + this.value;
            });
        });

        let elements = document.querySelectorAll(".delete");
        elements.forEach(function (element, key) {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтверждаете удаление записи с #ID = ${id}`)) {
                    send(`/admin/news/${id}`).then( () => {
                        //location.reload();
                        console.log(id);
                        document.getElementById(id).remove();
                    });
                } else {
                    alert("Вы отменили удаление записи");
                }
            });
        });


        async function send(url) {
            let response = await fetch (url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
