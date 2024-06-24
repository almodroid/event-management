<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Event Management</h1>
        <a href="{{ route('events.index') }}">View Events</a>
    </div>
@endsection
