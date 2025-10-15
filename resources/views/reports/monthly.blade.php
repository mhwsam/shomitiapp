@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <span class="badge">Reports</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Monthly Summary</h1>
      <p class="mt-2 text-sm text-slate-500">Track collection performance for a specific month and identify contribution trends.</p>
    </div>
    <div class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm">
      Period: <span class="font-semibold text-slate-900">{{ $month }}/{{ $year }}</span>
    </div>
  </section>

  <section class="surface-panel p-6 sm:p-8">
    <form method="GET" class="grid gap-4 sm:grid-cols-3 lg:grid-cols-5">
      <div class="space-y-2">
        <label for="year">Year</label>
        <input id="year" type="number" name="year" value="{{ $year }}" min="2000" max="2100">
      </div>
      <div class="space-y-2">
        <label for="month">Month (1-12)</label>
        <input id="month" type="number" name="month" value="{{ $month }}" min="1" max="12">
      </div>
      <div class="space-y-2 sm:col-span-2 lg:col-span-2">
        <label class="invisible">Actions</label>
        <div class="flex flex-wrap gap-3">
          <button class="btn-primary">Apply</button>
          <a href="{{ route('reports.monthly') }}" class="btn-outline">Reset</a>
        </div>
      </div>
    </form>
  </section>

  <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    <x-kpi label="Total Due"  value="৳{{ number_format($summary['total_due']) }}" />
    <x-kpi label="Total Paid" value="৳{{ number_format($summary['total_paid']) }}" />
    <x-kpi label="Payments Count" value="{{ number_format($summary['count']) }}" />
  </section>

  <section class="surface-panel overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
            <th class="px-6 py-3">Member</th>
            <th class="px-6 py-3">Period</th>
            <th class="px-6 py-3">Due</th>
            <th class="px-6 py-3">Paid</th>
            <th class="px-6 py-3">Method</th>
            <th class="px-6 py-3">Paid On</th>
            <th class="px-6 py-3">Receipt</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @forelse($payments as $p)
            <tr class="border-t border-slate-200 transition-colors duration-200 hover:bg-slate-100">
              <td class="px-6 py-4">
                <div class="font-semibold text-slate-900">{{ $p->member->full_name_bn ?? $p->member->full_name_en }}</div>
                <div class="text-sm text-slate-500">{{ $p->member->member_no }}</div>
              </td>
              <td class="px-6 py-4 text-slate-600">{{ $p->month }}/{{ $p->year }}</td>
              <td class="px-6 py-4 font-semibold text-slate-900">৳{{ number_format($p->amount_due) }}</td>
              <td class="px-6 py-4 font-semibold text-emerald-600">৳{{ number_format($p->amount_paid) }}</td>
              <td class="px-6 py-4 text-slate-600">{{ $p->method ?? 'N/A' }}</td>
              <td class="px-6 py-4 text-slate-600">{{ optional($p->paid_on)->format('d M @ h:i A') }}</td>
              <td class="px-6 py-4">
                <div class="flex flex-wrap gap-2">
                  <a href="{{ route('collections.receipt.show', $p) }}" class="btn-ghost text-xs font-semibold text-blue-600 hover:text-blue-800">
                    View
                  </a>
                  <a href="{{ route('collections.receipt.download', $p) }}" class="btn-ghost text-xs font-semibold text-slate-600 hover:text-slate-900" target="_blank" rel="noopener">
                    PDF
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">No payments found for this period.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <div class="flex flex-col gap-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
    <div>Showing {{ $payments->count() }} of {{ $payments->total() }} payments</div>
    <div>{{ $payments->onEachSide(1)->links() }}</div>
  </div>
</div>
@endsection
