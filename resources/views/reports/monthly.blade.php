@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Monthly Report</h1>

<form method="GET" class="mt-4 flex flex-wrap items-end gap-2">
  <div>
    <label class="block text-xs text-gray-600">Year</label>
    <input type="number" name="year" value="{{ $year }}" class="mt-1 w-40 rounded-xl border px-3 py-2">
  </div>
  <div>
    <label class="block text-xs text-gray-600">Month (1-12)</label>
    <input type="number" name="month" value="{{ $month }}" min="1" max="12" class="mt-1 w-40 rounded-xl border px-3 py-2">
  </div>
  <button class="rounded-xl border px-4 py-2 hover:bg-gray-50">Apply</button>
</form>

<div class="mt-4 grid gap-4 sm:grid-cols-3">
  <x-kpi label="Total Due"  value="৳{{ number_format($summary['total_due']) }}" />
  <x-kpi label="Total Paid" value="৳{{ number_format($summary['total_paid']) }}" />
  <x-kpi label="Payments Count" value="{{ number_format($summary['count']) }}" />
</div>

<div class="mt-4 overflow-x-auto rounded-2xl border bg-white">
  <table class="min-w-full text-sm">
    <thead class="bg-gray-50 text-left text-gray-600">
      <tr>
        <th class="px-4 py-3">Member</th>
        <th class="px-4 py-3">Month</th>
        <th class="px-4 py-3">Due</th>
        <th class="px-4 py-3">Paid</th>
        <th class="px-4 py-3">Method</th>
        <th class="px-4 py-3">Paid On</th>
      </tr>
    </thead>
    <tbody>
      @forelse($payments as $p)
        <tr class="border-t">
          <td class="px-4 py-3">
            <div class="font-medium">{{ $p->member->full_name_bn ?? $p->member->full_name_en }}</div>
            <div class="text-xs text-gray-500">{{ $p->member->member_no }}</div>
          </td>
          <td class="px-4 py-3">{{ $p->month }}/{{ $p->year }}</td>
          <td class="px-4 py-3">৳{{ number_format($p->amount_due) }}</td>
          <td class="px-4 py-3">৳{{ number_format($p->amount_paid) }}</td>
          <td class="px-4 py-3">{{ $p->method }}</td>
          <td class="px-4 py-3">{{ optional($p->paid_on)->format('d M, h:i A') }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No payments found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $payments->links() }}</div>
@endsection
