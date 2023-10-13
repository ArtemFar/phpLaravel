@extends('layouts.main')
@section('content')
    @include('inc.message')
    <h1>Order form for receiving data upload</h1>
    @if($errors->any())
            @foreach($errors->all() as $error)
                <x-alert :message="$error" type="danger"></x-alert>
            @endforeach
        @endif
    <form action=" {{route('order-form.showForm')}} " method="POST">
        @csrf
        <label for="name">Customer's name:</label>
        <input type="text" class="form-control" name="name" id="name" value=" {{old('name')}} " required>
        <br>

        <label for="phone">Phone number:</label>
        <input type="tel" class="form-control" name="phone" id="phone" value=" {{old('phone')}} " required>
        <br>

        <label for="email">Email address:</label>
        <input type="email" class="form-control" name="email" id="email" value=" {{old('email')}} " required>
        <br>

        <label for="information">What do you want to get:</label>
        <textarea name="information" class="form-control" id="information" required> {{old('information')}} </textarea>
        <br>

        <button type="submit" class="btn btn-success">Send an order</button>
    </form>
@endsection
