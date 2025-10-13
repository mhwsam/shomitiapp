<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $title ?? 'Shomiti Admin' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
  <header class="bg-white border-b">
    <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="font-semibold">🟢 Shomiti</a>
      @auth
      <nav class="flex items-center gap-2">
        <a href="{{ route('members.index') }}" class="px-3 py-2 text-sm hover:text-blue-600">Members</a>
        <a href="{{ route('collections.create') }}" class="px-3 py-2 text-sm hover:text-blue-600">Collect</a>
        <a href="{{ route('reports.unpaid') }}" class="px-3 py-2 text-sm hover:text-blue-600">Unpaid</a>
        <a href="{{ route('reports.monthly') }}" class="px-3 py-2 text-sm hover:text-blue-600">Monthly</a>
        <form method="POST" action="{{ route('logout') }}" class="ml-2">
          @csrf
          <button class="rounded-lg border px-3 py-2 text-sm hover:bg-gray-50">Logout</button>
        </form>
      </nav>
      @endauth
    </div>
  </header>

  <main class="mx-auto max-w-7xl px-4 py-6">
    @if (session('ok'))
      <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
        {{ session('ok') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
        <div class="font-semibold mb-1">Please fix the following:</div>
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>
