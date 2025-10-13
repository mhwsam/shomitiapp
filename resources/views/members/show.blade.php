@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <div>
      <span class="badge">Member Profile</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $member->full_name_bn ?? $member->full_name_en }}</h1>
      <p class="mt-2 text-sm text-slate-500">Member no. {{ $member->member_no }} • Status: {{ ucfirst($member->status ?? 'inactive') }}</p>
    </div>
    <div class="flex flex-wrap gap-3">
      <a href="{{ route('members.edit',$member) }}" class="btn-outline">Edit Details</a>
      <a href="{{ route('members.print',$member) }}" class="btn-primary">Print Profile</a>
    </div>
  </section>

  <section class="grid gap-6 lg:grid-cols-3">
    <div class="surface-panel p-6 lg:col-span-2">
      <h2 class="text-lg font-semibold text-slate-900">Contact &amp; Membership</h2>
      <dl class="mt-4 grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
        <div class="space-y-1">
          <dt class="text-sm font-semibold text-slate-600">Member No</dt>
          <dd class="text-base font-semibold text-slate-900">{{ $member->member_no }}</dd>
        </div>
        <div class="space-y-1">
          <dt class="text-sm font-semibold text-slate-600">Mobile</dt>
          <dd class="text-base font-semibold text-slate-900">{{ $member->mobile }}</dd>
        </div>
        <div class="space-y-1">
          <dt class="text-sm font-semibold text-slate-600">Email</dt>
          <dd class="text-base font-medium text-slate-700">{{ $member->email ?: 'Not provided' }}</dd>
        </div>
        <div class="space-y-1">
          <dt class="text-sm font-semibold text-slate-600">Join Date</dt>
          <dd class="text-base font-medium text-slate-700">{{ optional($member->join_date ? \Illuminate\Support\Carbon::parse($member->join_date) : null)->format('d M Y') ?? 'N/A' }}</dd>
        </div>
        <div class="space-y-1 sm:col-span-2">
          <dt class="text-sm font-semibold text-slate-600">Present Address</dt>
          <dd class="text-base font-medium text-slate-700">{{ $member->present_address ?: 'Not provided' }}</dd>
        </div>
        @if($member->remarks)
          <div class="space-y-1 sm:col-span-2">
            <dt class="text-sm font-semibold text-slate-600">Remarks</dt>
            <dd class="rounded-lg border border-slate-200 bg-white p-4 text-sm text-slate-700">{{ $member->remarks }}</dd>
          </div>
        @endif
      </dl>
    </div>

    <div class="surface-panel flex flex-col items-center gap-4 p-6 text-center">
      <div class="relative">
        <span class="absolute -right-3 -top-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white shadow-sm">ID</span>
        @if($member->photo_path)
          <img src="{{ asset('storage/'.$member->photo_path) }}" alt="{{ $member->full_name_bn ?? 'Member photo' }}" class="mx-auto h-40 w-40 rounded-3xl object-cover shadow-lg shadow-slate-900/10">
        @else
          @php
            $initial = \Illuminate\Support\Str::of($member->full_name_bn ?? $member->full_name_en ?? 'M')->substr(0,1)->upper();
          @endphp
          <div class="mx-auto flex h-40 w-40 items-center justify-center rounded-3xl bg-slate-200 text-4xl font-semibold text-slate-600">
            {{ $initial }}
          </div>
        @endif
      </div>
      <div class="space-y-2 text-sm text-slate-600">
        <div class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-600">
          {{ ucfirst($member->status ?? 'inactive') }}
        </div>
        <p>Keep member details updated to ensure smooth collections and communication.</p>
      </div>
    </div>
  </section>
</div>
@endsection
