@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Registration</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('registration') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="mt-1 block w-full p-2 border rounded" required>
            </div>
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="mt-1 block w-full p-2 border rounded" placeholder="+380671234567" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Register</button>
        </form>
    </div>
@endsection
