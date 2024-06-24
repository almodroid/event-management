<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Events</h1>
        @foreach($events as $event)
            <div>
                <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
            </div>
        @endforeach
    </div>
@endsection
