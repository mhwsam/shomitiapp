<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $title ?? 'Shomiti Admin' }}</title>
  <style>[x-cloak]{display:none!important;}</style>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
@php
  $navLinks = [
    ['label' => 'Dashboard', 'route' => 'dashboard', 'pattern' => 'dashboard'],
    ['label' => 'Members', 'route' => 'members.index', 'pattern' => 'members.*'],
    ['label' => 'Collect', 'route' => 'collections.create', 'pattern' => 'collections.*'],
    ['label' => 'Reports', 'route' => 'reports.monthly', 'pattern' => 'reports.*'],
  ];
@endphp
<body class="min-h-screen">
  <div x-data="{ mobileNav: false }" class="flex min-h-screen flex-col">
    <header class="border-b border-slate-200 bg-white">
      <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center gap-3">
          <span class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-600 text-base font-semibold text-white">S</span>
          <span class="hidden sm:inline-flex flex-col">
            <span class="text-base font-semibold text-slate-900">Shomiti Admin</span>
            <span class="text-xs text-slate-500">Member &amp; Collection Hub</span>
          </span>
        </a>
        <div class="flex items-center gap-3">
          @auth
            <nav class="hidden items-center gap-2 text-sm md:flex">
              @foreach ($navLinks as $item)
                @php $active = request()->routeIs($item['pattern']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="{{ $active ? 'nav-pill-active' : 'nav-pill' }}">
                  {{ $item['label'] }}
                </a>
              @endforeach
            </nav>
          @endauth
          @guest
            <a href="{{ route('login') }}" class="hidden text-sm font-semibold text-slate-600 hover:text-slate-900 sm:inline-flex">Login</a>
          @endguest
          @auth
            <div class="hidden text-right text-xs text-slate-500 sm:block">
              <span class="block text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</span>
              <span>{{ ucfirst(auth()->user()->role ?? 'admin') }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
              @csrf
              <button class="btn-ghost text-xs font-semibold">Logout</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn-primary text-xs font-semibold sm:hidden">Login</a>
          @endauth
          @auth
            <button type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-slate-600 md:hidden"
                    @click="mobileNav = !mobileNav"
                    :aria-expanded="mobileNav"
                    aria-label="Toggle navigation">
              <svg x-show="!mobileNav" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg x-show="mobileNav" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6" />
              </svg>
            </button>
          @endauth
        </div>
      </div>
      @auth
        <div class="border-t border-slate-200 bg-slate-50 md:hidden" x-show="mobileNav" x-transition x-cloak>
          <div class="space-y-2 px-4 py-3 text-sm text-slate-700">
            @foreach ($navLinks as $item)
              @php $active = request()->routeIs($item['pattern']); @endphp
              <a href="{{ route($item['route']) }}"
                 class="block rounded-lg px-3 py-2 font-medium {{ $active ? 'bg-blue-50 text-blue-700' : 'hover:bg-white hover:text-slate-900' }}"
                 @click="mobileNav = false">
                {{ $item['label'] }}
              </a>
            @endforeach
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="mt-2 w-full rounded-lg bg-white px-3 py-2 text-left text-sm font-semibold text-slate-700 hover:bg-slate-100">
                Logout
              </button>
            </form>
          </div>
        </div>
      @endauth
    </header>

    <main class="flex-1 bg-slate-100">
      <div class="mx-auto w-full max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
          <div class="p-6 sm:p-8">
            @if (session('ok'))
              <div class="mb-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.072 7.07a1 1 0 01-1.414 0L3.296 8.86a1 1 0 111.414-1.42L8.5 11.23l6.79-6.79a1 1 0 011.414.85z" clip-rule="evenodd" />
                  </svg>
                </span>
                <span>{{ session('ok') }}</span>
              </div>
            @endif
            @if ($errors->any())
              <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <div class="mb-2 font-semibold">Please fix the following:</div>
                <ul class="list-disc space-y-1 pl-4">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @yield('content')
          </div>
        </div>
      </div>
    </main>

    <footer class="border-t border-slate-200 bg-white">
      <div class="mx-auto w-full max-w-7xl px-4 py-6 text-sm text-slate-500 sm:px-6 lg:px-8">
        &copy; {{ now()->year }} Shomiti Admin. Crafted for cooperative administrators.
      </div>
    </footer>
  </div>
</body>
</html>
