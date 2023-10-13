@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Control Panel</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    @include('inc.message')
    <x-alert :type="request()->get('type','light')" message="Notification"></x-alert>
    <x-alert type="danger" message="Notification"></x-alert>
    <x-alert type="warning" message="Notification"></x-alert>
    <x-alert type="success" message="Notification"></x-alert>
    <x-alert type="info" message="Notification"></x-alert>
    <x-alert type="dark" message="Notification"></x-alert>
    <x-alert type="primary" message="Notification"></x-alert>
@endsection
