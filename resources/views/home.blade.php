@extends('layouts.app')

@section('content')
<div class="rounded-xl border border-slate-200 bg-white px-8 py-12 text-center shadow-sm">
  <div class="mx-auto max-w-2xl space-y-6">
    <span class="badge inline-flex">Community Platform</span>
    <h1 class="text-4xl font-semibold leading-tight text-slate-900">Shomiti, reimagined for modern cooperatives</h1>
    <p class="text-base text-slate-600">Manage members, track monthly collections, and gain clarity over outstanding dues - all from a clear, mobile-ready dashboard.</p>
    <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
      @guest
        <a href="{{ route('login') }}" class="btn-primary text-base">Login to Continue</a>
        <a href="{{ route('register') }}" class="btn-outline text-base">Create an Account</a>
      @else
        <a href="{{ route('dashboard') }}" class="btn-primary text-base">Go to Dashboard</a>
        <a href="{{ route('members.index') }}" class="btn-outline text-base">Browse Members</a>
      @endguest
    </div>
  </div>
</div>
@endsection
