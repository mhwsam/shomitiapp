@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <span class="badge">Reports</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Unpaid Members</h1>
      <p class="mt-2 text-sm text-slate-500">Identify members who still owe the monthly contribution for a specific period.</p>
    </div>
    <div class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm">
      Monthly fee: ৳{{ number_format($fee) }}
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
          <a href="{{ route('reports.unpaid') }}" class="btn-outline">Reset</a>
        </div>
      </div>
    </form>
  </section>

  <section class="surface-panel overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
            <th class="px-6 py-3">Member No</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Mobile</th>
            <th class="px-6 py-3">Due</th>
            <th class="px-6 py-3 text-right">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @forelse($members as $m)
            <tr class="border-t border-slate-200 transition-colors duration-200 hover:bg-slate-100">
              <td class="px-6 py-4 font-semibold text-slate-900">{{ $m->member_no }}</td>
              <td class="px-6 py-4 text-slate-700">{{ $m->full_name_bn ?? $m->full_name_en }}</td>
              <td class="px-6 py-4 text-slate-600">{{ $m->mobile }}</td>
              <td class="px-6 py-4 font-semibold text-rose-600">৳{{ number_format($fee) }}</td>
              <td class="px-6 py-4 text-right">
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-700"
                   href="{{ route('collections.create', ['member'=>$m->id,'year'=>$year,'month'=>$month]) }}">Collect</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">All members are paid for this cycle!</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <div class="flex flex-col gap-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
    <div>Showing {{ $members->count() }} of {{ $members->total() }} members</div>
    <div>{{ $members->onEachSide(1)->links() }}</div>
  </div>
</div>
@endsection
