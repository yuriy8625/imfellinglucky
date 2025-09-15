@extends('layouts.app')

@section('title', 'Page A')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Hello, {{ $user->username }}!</h1>
        <p class="text-center text-sm text-gray-500 mt-2">This link expires at {!! $user->token_expires_at !!}</p>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {!! session('success') !!}
            </div>
        @endif

        @if (!empty($result))
            <div class="bg-blue-100 text-blue-700 p-4 rounded mb-4">
                <p>Rand num: {{ $result['number'] }}</p>
                <p>Result: {{ $result['status'] }}</p>
                <p>Prize: {{ number_format($result['amount'], 2) }}</p>
            </div>
        @endif

        <div class="space-y-4 mt-4">
            <form action="{{ route('refresh-token', $user->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Generate new link</button>
            </form>
            <form action="{{ route('deactivate-token', $user->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700">Deactivate link</button>
            </form>
            <form action="{{ route('page-a.lucky', $user->token) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">I'm Feeling Lucky</button>
            </form>
            <a href="{{ route('page-a.history', $user->token) }}" class="block w-full bg-gray-600 text-white p-2 rounded hover:bg-gray-700 text-center">History</a>
        </div>
    </div>
@endsection
