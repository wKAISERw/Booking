@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Адміністратори</h1>
    <ul>
        @foreach($admins as $admin)
            <li><a href="{{ route('chat', $admin->id) }}">{{ $admin->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
