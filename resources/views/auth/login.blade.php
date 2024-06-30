@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Login to Your Account</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label for="login" class="block text-gray-700 font-semibold mb-2">Email or Username</label>
            <input type="text" id="login" name="login" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('login') border-red-500 @enderror" value="{{ old('login') }}" placeholder="Enter your email or username" required>
            @error('login')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" placeholder="Enter your password" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4 flex items-center justify-between">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="remember">
                <span class="ml-2 text-gray-700">Remember me</span>
            </label>
        </div>
        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
        </div>
    </form>
    <p class="text-gray-700">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign up</a></p>
</div>
@endsection
