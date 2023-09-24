@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Панель управления</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>

    @include('inc.message')

    <x-alert :type="request()->get('type', 'info')" message="Это просто уведомление"></x-alert>
    <x-alert type="danger" message="Это просто уведомление1"></x-alert>
    <x-alert type="warning" message="Это просто уведомление2"></x-alert>
    <x-alert type="success" message="Это просто уведомление3"></x-alert>
    <x-alert type="info" message="Это просто уведомление4"></x-alert>
    <x-alert type="dark" message="Это просто уведомление5"></x-alert>
    <x-alert type="primary" message="Это просто уведомление6"></x-alert>
@endsection
