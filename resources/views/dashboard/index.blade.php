{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- Page header + actions --}}
<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
  <div>
    <h1 class="text-xl font-semibold">Dashboard</h1>
    <p class="text-sm text-gray-500">Overview for {{ $filters['months'][$filters['month']] }} {{ $filters['year'] }}</p>
  </div>

  <div class="flex flex-wrap items-center gap-2">
    <a href="{{ route('members.create') }}" class="rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Add Member</a>
    <a href="{{ route('collections.create') }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Collect Payment</a>
  </div>
</div>

{{-- Filters --}}
<form method="GET" class="mt-4 grid gap-2 sm:grid-cols-4">
  <div>
    <label class="block text-xs text-gray-600">Month</label>
    <select name="month" class="mt-1 w-full rounded-xl border px-3 py-2">
      @foreach($filters['months'] as $m => $name)
        <option value="{{ $m }}" @selected($m == $filters['month'])>{{ $name }}</option>
      @endforeach
    </select>
  </div>
  <div>
    <label class="block text-xs text-gray-600">Year</label>
    <select name="year" class="mt-1 w-full rounded-xl border px-3 py-2">
      @foreach($filters['years'] as $y)
        <option value="{{ $y }}" @selected($y == $filters['year'])>{{ $y }}</option>
      @endforeach
    </select>
  </div>
  <div class="sm:col-span-2 flex items-end gap-2">
    <button class="rounded-xl bg-gray-900 px-4 py-2 text-white hover:bg-black">Apply</button>
    <a href="{{ route('dashboard') }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Reset</a>
  </div>
</form>

{{-- KPI cards --}}
<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
  <x-kpi label="Total Collected (All Time)" value="৳{{ number_format($stats['total_collected']) }}" />
  <x-kpi label="Last Month Collection" value="৳{{ number_format($stats['last_month_total']) }}" />
  <x-kpi label="Total Members" value="{{ number_format($stats['members_count']) }}" />
  <x-kpi label="Unpaid (Selected Month)" value="{{ number_format($stats['unpaid_count']) }}" />
</div>

{{-- Two-column panels --}}
<div class="mt-6 grid gap-6 lg:grid-cols-3">
  {{-- Recent Payments --}}
  <section class="lg:col-span-2 rounded-2xl border bg-white shadow-sm">
    <div class="flex items-center justify-between border-b px-4 py-3">
      <h2 class="text-sm font-semibold">Recent Payments</h2>
      <a href="{{ route('collections.create') }}" class="text-sm text-blue-600 hover:underline">Record a payment</a>
    </div>

    @if(empty($recentPayments))
      <div class="p-6 text-center text-sm text-gray-500">No payments yet.</div>
    @else
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-gray-50 text-left text-gray-600">
            <tr>
              <th class="px-4 py-3">Member</th>
              <th class="px-4 py-3">Month</th>
              <th class="px-4 py-3">Amount</th>
              <th class="px-4 py-3">Method</th>
              <th class="px-4 py-3">Paid On</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentPayments as $p)
              <tr class="border-t">
                <td class="px-4 py-3">
                  <div class="font-medium">{{ $p['member_name'] }}</div>
                  <div class="text-xs text-gray-500">{{ $p['member_no'] }}</div>
                </td>
                <td class="px-4 py-3">{{ $filters['months'][$p['month']] }} {{ $p['year'] }}</td>
                <td class="px-4 py-3 font-medium">৳{{ number_format($p['amount']) }}</td>
                <td class="px-4 py-3">{{ $p['method'] }}</td>
                <td class="px-4 py-3">
                  @if(!empty($p['paid_on']))
                    {{ \Carbon\Carbon::parse($p['paid_on'])->format('d M, h:i A') }}
                  @else
                    —
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>

  {{-- Unpaid members (selected month) --}}
  <section class="rounded-2xl border bg-white shadow-sm">
    <div class="flex items-center justify-between border-b px-4 py-3">
      <h2 class="text-sm font-semibold">Unpaid Members</h2>
      <a href="{{ route('reports.unpaid', ['month'=>$filters['month'],'year'=>$filters['year']]) }}" class="text-sm text-blue-600 hover:underline">View all</a>
    </div>

    @if(empty($unpaidMembers))
      <div class="p-6 text-center text-sm text-gray-500">Great! Everyone is paid.</div>
    @else
      <ul class="divide-y">
        @foreach(array_slice($unpaidMembers,0,8) as $u)
          <li class="px-4 py-3">
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">{{ $u['member_name'] }}</div>
                <div class="text-xs text-gray-500">{{ $u['member_no'] }} • {{ $u['mobile'] }}</div>
              </div>
              <div class="text-right">
                <div class="text-sm font-semibold">৳{{ number_format($u['due']) }}</div>
                <a href="{{ route('collections.create', ['member' => $u['member_no'], 'month'=>$filters['month'], 'year'=>$filters['year']]) }}"
                   class="text-xs text-blue-600 hover:underline">Collect</a>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
      @if(count($unpaidMembers) > 8)
        <div class="px-4 py-2 text-xs text-gray-500">+ {{ count($unpaidMembers)-8 }} more unpaid…</div>
      @endif
    @endif
  </section>
</div>

{{-- Helpful links --}}
<div class="mt-6 flex flex-wrap gap-2">
  <a href="{{ route('reports.monthly', ['month'=>$filters['month'],'year'=>$filters['year']]) }}" class="rounded-xl border px-4 py-2 text-sm hover:bg-gray-50">Monthly Report</a>
  <a href="{{ route('reports.unpaid') }}" class="rounded-xl border px-4 py-2 text-sm hover:bg-gray-50">Unpaid Report</a>
</div>
@endsection
