@extends('layouts.app');

@section('title','Add Room')
@section('content')
<h2>Room List</h2>
<ul>
@foreach($rooms as $room)
    <li>{{ $room->number }} (description: {{ $room->description }}) : {{ $room->price }}</li>
@endforeach
</ul>

<form action="/rooms" method="POST">
    @csrf
    <input type="text" name="price" placeholder="price">
    <input type="text" name="number" placeholder="Room Number">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Add Room</button>
</form>

@endsection

