{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="space-y-10">
  <section class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <span class="badge">Executive Overview</span>
      <h1 class="mt-3 text-4xl font-semibold text-slate-900">Dashboard</h1>
      <p class="mt-2 max-w-2xl text-sm text-slate-500">Real-time insight for {{ $filters['months'][$filters['month']] }} {{ $filters['year'] }} across payments, member activity, and outstanding dues.</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
      <a href="{{ route('members.create') }}" class="btn-primary">Add Member</a>
      <a href="{{ route('collections.create') }}" class="btn-outline">Record Collection</a>
    </div>
  </section>

  <section class="surface-panel p-5 sm:p-6">
    <form method="GET" class="grid gap-4 sm:grid-cols-4">
      <div class="space-y-2">
        <label for="month">Month</label>
        <select id="month" name="month">
          @foreach($filters['months'] as $m => $name)
            <option value="{{ $m }}" @selected($m == $filters['month'])>{{ $name }}</option>
          @endforeach
        </select>
      </div>
      <div class="space-y-2">
        <label for="year">Year</label>
        <select id="year" name="year">
          @foreach($filters['years'] as $y)
            <option value="{{ $y }}" @selected($y == $filters['year'])>{{ $y }}</option>
          @endforeach
        </select>
      </div>
      <div class="space-y-2 sm:col-span-2">
        <label class="invisible">Actions</label>
        <div class="flex flex-wrap gap-3">
          <button class="btn-primary">Apply</button>
          <a href="{{ route('dashboard') }}" class="btn-outline">Reset</a>
        </div>
      </div>
    </form>
  </section>

  <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <x-kpi label="Total Collected (All Time)" value="৳{{ number_format($stats['total_collected']) }}" />
    <x-kpi label="Last Month Collection" value="৳{{ number_format($stats['last_month_total']) }}" />
    <x-kpi label="Total Members" value="{{ number_format($stats['members_count']) }}" />
    <x-kpi label="Unpaid (Selected Month)" value="{{ number_format($stats['unpaid_count']) }}" />
  </section>

  <section class="grid gap-6 xl:grid-cols-3">
    <div class="surface-panel overflow-hidden xl:col-span-2">
      <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Recent Payments</h2>
          <p class="text-sm text-slate-500">Latest 10 transactions from the collection desk.</p>
        </div>
        <a href="{{ route('collections.create') }}" class="btn-outline text-sm font-semibold">Record Payment</a>
      </div>

      @if(empty($recentPayments))
        <div class="px-6 py-10 text-center text-sm text-slate-500">No payments recorded yet. Start by collecting from a member.</div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
                <th class="px-6 py-3">Member</th>
                <th class="px-6 py-3">Month</th>
                <th class="px-6 py-3">Amount</th>
                <th class="px-6 py-3">Method</th>
                <th class="px-6 py-3">Paid On</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach($recentPayments as $p)
                <tr class="border-t border-slate-200 transition-colors duration-200 hover:bg-slate-100">
                  <td class="px-6 py-4">
                    <div class="font-semibold text-slate-900">{{ $p['member_name'] }}</div>
                    <div class="text-sm text-slate-500">{{ $p['member_no'] }}</div>
                  </td>
                  <td class="px-6 py-4 text-slate-600">{{ $filters['months'][$p['month']] }} {{ $p['year'] }}</td>
                  <td class="px-6 py-4 font-semibold text-slate-900">৳{{ number_format($p['amount']) }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ $p['method'] ?? 'N/A' }}</td>
                  <td class="px-6 py-4 text-slate-600">
                    @if(!empty($p['paid_on']))
                      {{ \Carbon\Carbon::parse($p['paid_on'])->format('d M @ h:i A') }}
                    @else
                      N/A
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

    <div class="surface-panel overflow-hidden">
      <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Unpaid Members</h2>
          <p class="text-sm text-slate-500">Snapshot for {{ $filters['months'][$filters['month']] }} {{ $filters['year'] }}.</p>
        </div>
        <a href="{{ route('reports.unpaid', ['month'=>$filters['month'],'year'=>$filters['year']]) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">View All</a>
      </div>

      @if(empty($unpaidMembers))
        <div class="px-6 py-10 text-center text-sm text-slate-500">Great news! Every member has settled dues for this cycle.</div>
      @else
        <ul class="divide-y divide-slate-200">
          @foreach(array_slice($unpaidMembers,0,8) as $u)
            <li class="px-6 py-4">
              <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <div class="font-semibold text-slate-900">{{ $u['member_name'] }}</div>
                  <div class="text-sm text-slate-500">{{ $u['member_no'] }} • {{ $u['mobile'] }}</div>
                </div>
                <div class="text-right">
                  <div class="text-sm font-semibold text-rose-600">৳{{ number_format($u['due']) }}</div>
                  <a href="{{ route('collections.create', ['member' => $u['member_no'], 'month'=>$filters['month'], 'year'=>$filters['year']]) }}"
                     class="text-sm font-semibold text-blue-600 hover:text-blue-700">Collect</a>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        @if(count($unpaidMembers) > 8)
          <div class="px-6 py-3 text-sm text-slate-500">+ {{ count($unpaidMembers)-8 }} more pending payments</div>
        @endif
      @endif
    </div>
  </section>

  <section class="surface-panel p-6">
    <h2 class="text-lg font-semibold text-slate-900">Quick Links</h2>
    <p class="mt-1 text-sm text-slate-600">Jump into detailed reports tailored for finance reviews.</p>
    <div class="mt-4 flex flex-wrap gap-3">
      <a href="{{ route('reports.monthly', ['month'=>$filters['month'],'year'=>$filters['year']]) }}" class="btn-outline">Monthly Report</a>
      <a href="{{ route('reports.unpaid') }}" class="btn-outline">Unpaid Summary</a>
    </div>
  </section>
</div>
@endsection
