@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Collect Payment</h1>

<form method="POST" action="{{ route('collections.store') }}" class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
  @csrf

  <div class="lg:col-span-2">
    <label class="block text-xs text-gray-600">Member</label>
    <select name="member_id" required class="mt-1 w-full rounded-xl border px-3 py-2">
      <option value="">— Select member —</option>
      @foreach($members as $m)
        <option value="{{ $m->id }}">{{ $m->member_no }} — {{ $m->full_name_bn ?? $m->full_name_en }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block text-xs text-gray-600">Year</label>
    <input type="number" name="year" value="{{ $year }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Month (1-12)</label>
    <input type="number" name="month" value="{{ $month }}" min="1" max="12" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Amount Due</label>
    <input type="number" name="amount_due" value="{{ $defaultDue }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Amount Paid</label>
    <input type="number" name="amount_paid" value="{{ $defaultDue }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Method</label>
    <select name="method" class="mt-1 w-full rounded-xl border px-3 py-2">
      <option value="">—</option>
      <option>Cash</option>
      <option>bKash</option>
      <option>Nagad</option>
      <option>Bank</option>
    </select>
  </div>

  <div class="lg:col-span-3">
    <label class="block text-xs text-gray-600">Reference / TxID (optional)</label>
    <input name="reference_no" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div class="lg:col-span-3 flex gap-2">
    <button class="rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
    <a href="{{ route('dashboard') }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Cancel</a>
  </div>
</form>
@endsection
