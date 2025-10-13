@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl text-center">
  <h1 class="text-2xl font-semibold">Welcome to Shomiti</h1>
  <p class="mt-2 text-gray-600">Simple member & monthly collection management.</p>
  @guest
    <a href="{{ route('login') }}" class="mt-6 inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">Login</a>
  @else
    <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center rounded-xl border px-5 py-3 hover:bg-gray-50">Go to Dashboard</a>
  @endguest
</div>
@endsection
