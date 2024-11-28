@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Користувачі</h1>
    @if($users->isEmpty())
        <p>Немає користувачів, які писали вам повідомлення.</p>
    @else
        <ul>
            @foreach($users as $user)
                <li>
                    <a href="{{ route('chat', ['id' => $user->id]) }}">{{ $user->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
