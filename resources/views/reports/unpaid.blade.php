@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Unpaid Members</h1>

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

<div class="mt-4 overflow-x-auto rounded-2xl border bg-white">
  <table class="min-w-full text-sm">
    <thead class="bg-gray-50 text-left text-gray-600">
      <tr>
        <th class="px-4 py-3">Member No</th>
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Mobile</th>
        <th class="px-4 py-3">Due (৳{{ $fee }})</th>
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody>
      @forelse($members as $m)
        <tr class="border-t">
          <td class="px-4 py-3 font-medium">{{ $m->member_no }}</td>
          <td class="px-4 py-3">{{ $m->full_name_bn ?? $m->full_name_en }}</td>
          <td class="px-4 py-3">{{ $m->mobile }}</td>
          <td class="px-4 py-3">৳{{ number_format($fee) }}</td>
          <td class="px-4 py-3 text-right">
            <a class="text-blue-600 hover:underline text-sm"
               href="{{ route('collections.create', ['member'=>$m->id,'year'=>$year,'month'=>$month]) }}">Collect</a>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">All members are paid 🎉</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $members->links() }}</div>
@endsection
