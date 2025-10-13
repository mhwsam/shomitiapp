@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <span class="badge">Collections</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Record Payment</h1>
      <p class="mt-2 max-w-2xl text-sm text-slate-500">Log a new monthly contribution with member, period, and payment details.</p>
    </div>
    <div class="rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
      Default monthly due: <span class="font-semibold">৳{{ number_format($defaultDue) }}</span>
    </div>
  </section>

  <section class="surface-panel p-6 sm:p-8">
    <form method="POST" action="{{ route('collections.store') }}" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @csrf

      <div class="space-y-2 lg:col-span-2">
        <label for="member_id">Member</label>
        <select id="member_id" name="member_id" required>
          <option value="">-- Select member --</option>
          @foreach($members as $m)
            <option value="{{ $m->id }}" @selected(old('member_id') == $m->id)>
              {{ $m->member_no }} - {{ $m->full_name_bn ?? $m->full_name_en }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="space-y-2">
        <label for="year">Year</label>
        <input id="year" type="number" name="year" value="{{ old('year', $year) }}" min="2000" max="2100">
      </div>

      <div class="space-y-2">
        <label for="month">Month (1-12)</label>
        <input id="month" type="number" name="month" value="{{ old('month', $month) }}" min="1" max="12">
      </div>

      <div class="space-y-2">
        <label for="amount_due">Amount Due</label>
        <input id="amount_due" type="number" name="amount_due" value="{{ old('amount_due', $defaultDue) }}" min="0">
      </div>

      <div class="space-y-2">
        <label for="amount_paid">Amount Paid</label>
        <input id="amount_paid" type="number" name="amount_paid" value="{{ old('amount_paid', $defaultDue) }}" min="0">
      </div>

      <div class="space-y-2">
        <label for="method">Method</label>
        <select id="method" name="method">
          <option value="">-- Select method --</option>
          @foreach(['Cash','bKash','Nagad','Bank'] as $method)
            <option value="{{ $method }}" @selected(old('method') === $method)>{{ $method }}</option>
          @endforeach
        </select>
      </div>

      <div class="space-y-2 lg:col-span-3">
        <label for="reference_no">Reference / TxID (optional)</label>
        <input id="reference_no" name="reference_no" value="{{ old('reference_no') }}" placeholder="Transaction reference, bKash ID, cheque number...">
      </div>

      <div class="lg:col-span-3 flex flex-wrap gap-3">
        <button class="btn-primary">Save Payment</button>
        <a href="{{ route('dashboard') }}" class="btn-outline">Cancel</a>
      </div>
    </form>
  </section>
</div>
@endsection
