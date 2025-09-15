@extends('layouts.app')

@section('title', 'History')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">History game for {{ $user->username }}</h1>
        <p class="text-center mb-4">Phone: {{ $user->phone_number }}</p>

        @if ($history->isEmpty())
            <p class="text-center text-gray-500">History is empty.</p>
        @else
            <ul class="space-y-4">
                @foreach ($history as $result)
                    <li class="border p-4 rounded">
                        <p>Number: {{ $result->number }}</p>
                        <p>Status: {{ $result->status }}</p>
                        <p>Prize: {{ number_format($result->amount, 2) }} $</p>
                        <p class="text-sm text-gray-500">Date: {{ $result->created_at->format('d.m.Y H:i') }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('page-a.index', $user->token) }}" class="block w-full bg-blue-600 text-white p-2 rounded mt-4 text-center hover:bg-blue-700">Back to page А</a>
    </div>
@endsection
