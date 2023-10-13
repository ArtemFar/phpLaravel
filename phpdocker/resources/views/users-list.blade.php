@extends('layouts.admin')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $h1 }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Создать пользователя</a>
            </div>
        </div>
    </div>
    @include('inc.message')
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Администратор</th>
                <th scope="col">Email</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user_item)
                <tr>
                    <td class="user-id">{{ $user_item->id }}</td>
                    <td {{ \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier() == $user_item->id ? 'class=active' : null }} >{{ $user_item->name }}</td>
                    <td>{{ $user_item->is_admin ? 'Да' : 'Нет'}}</td>
                    <td>{{ $user_item->email }}</td>
                    <td>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a href="{{route('admin.users.edit', $user_item->id)}}"
                                   type="button" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary delete-btn">Удалить
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <h2>Пользователей нет</h2>
            @endforelse

            </tbody>
        </table>
        {{ $users->links() }}
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
            return result.ok;
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.table-striped').addEventListener('click', (event) => {
                if (event.target.classList.contains('delete-btn')) {
                    let currentUserId = {{\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()}};
                    const activeRow = event.target.closest('tr');
                    const activeId = parseInt(activeRow.querySelector('.user-id').textContent);
                    if(currentUserId === activeId){
                        return false;
                    }
                    if (confirm(`Удалить пользователя с #ID = ${activeId}`)) {
                        deleteItem(`/admin/users/${activeId}`);
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
