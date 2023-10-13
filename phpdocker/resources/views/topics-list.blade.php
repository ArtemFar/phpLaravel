@extends('layouts.admin')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список категорий</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить
                    категорию</a>
            </div>
        </div>
    </div>
    @include('inc.message')
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Url Адрес</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($topics as $topic)
                <tr>
                    <td class="category-id">{{ $topic->id }}</td>
                    <td>{{ $topic->title }}</td>
                    <td>
                        <a href="{{ route('categories.topics-detail', ['url_slug' => $topic->url_slug]) }}">{{ route('categories.topics-detail', ['url_slug' => $topic->url_slug]) }}</a>
                    </td>
                    <td>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a type="button" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary delete-btn">Удалить</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <h2>Новостей нет</h2>
            @endforelse
            </tbody>
        </table>
        {{ $topics->links() }}
    </div>
@endsection
@push('js')
    <script>
        async function deleteItem(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            let result = await response.json();
            console.log(result)
            return result.ok;
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.table-striped').addEventListener('click', (event) => {
                if (event.target.classList.contains('delete-btn')) {
                    const activeRow = event.target.closest('tr');
                    const activeId = parseInt(activeRow.querySelector('.category-id').textContent);
                    if (confirm(`Удалить категорию с #ID = ${activeId}`)) {
                        deleteItem(`/admin/categories/${activeId}`);
                        activeRow.remove();
                    }else {
                        return false;
                    }
                }
                return false;
            });
        });
    </script>
@endpush
