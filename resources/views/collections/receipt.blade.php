@extends('layouts.app')

@section('content')
@php
  $member = $payment->member;
  $memberName = $member?->full_name_bn ?: ($member?->full_name_en ?? 'N/A');
  $memberNo = $member?->member_no ?? 'N/A';
  $collectorName = $payment->collector?->name ?? 'System';
  $paidOn = optional($payment->paid_on)->format('d M Y h:i A');
  $receiptNumber = 'RCPT-' . str_pad((string) $payment->id, 5, '0', STR_PAD_LEFT);
@endphp

<div class="space-y-8">
  <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <span class="badge">Receipt</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Payment Receipt</h1>
      <p class="mt-2 text-sm text-slate-500">View receipt details, print for your records, or download a PDF copy.</p>
    </div>
    <div class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm">
      Receipt #: <span class="font-semibold text-slate-900">{{ $receiptNumber }}</span>
    </div>
  </section>

  <section class="surface-panel space-y-6 p-6 sm:p-8">
    <div class="flex flex-wrap gap-3 print:hidden">
      <a href="{{ route('collections.receipt.download', $payment) }}" class="btn-primary" target="_blank" rel="noopener">
        Download PDF
      </a>
      <button type="button" class="btn-outline" onclick="window.print()">
        Print
      </button>
      <a href="{{ url()->previous() }}" class="btn-ghost">
        Back
      </a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 sm:p-10">
      <header class="mb-8 text-center">
        <h2 class="text-2xl font-semibold text-slate-900">{{ $committeeName }}</h2>
        <p class="mt-1 text-sm text-slate-500">Monthly Collection Receipt</p>
      </header>

      <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
          <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Receipt Info</h3>
          <dl class="mt-4 space-y-3 text-sm text-slate-600">
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Receipt Number</dt>
              <dd class="font-semibold text-slate-900">{{ $receiptNumber }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Period</dt>
              <dd class="font-semibold text-slate-900">{{ $period }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Generated</dt>
              <dd>{{ $generatedAt->format('d M Y h:i A') }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Paid On</dt>
              <dd>{{ $paidOn ?: 'N/A' }}</dd>
            </div>
          </dl>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
          <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Member</h3>
          <dl class="mt-4 space-y-3 text-sm text-slate-600">
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Member ID</dt>
              <dd class="font-semibold text-slate-900">{{ $memberNo }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Name</dt>
              <dd class="font-semibold text-slate-900">{{ $memberName }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Mobile</dt>
              <dd>{{ $member->mobile ?? 'N/A' }}</dd>
            </div>
            <div class="flex justify-between gap-6">
              <dt class="font-medium text-slate-500">Email</dt>
              <dd>{{ $member->email ?? 'N/A' }}</dd>
            </div>
          </dl>
        </div>
      </div>

      <div class="mt-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Payment Summary</h3>
        <dl class="mt-4 grid gap-4 text-sm text-slate-600 sm:grid-cols-2">
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Amount Due</dt>
            <dd class="font-semibold text-slate-900">{{ $currency }} {{ number_format($payment->amount_due, 2) }}</dd>
          </div>
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Amount Paid</dt>
            <dd class="font-semibold text-emerald-600">{{ $currency }} {{ number_format($payment->amount_paid, 2) }}</dd>
          </div>
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Method</dt>
            <dd>{{ $payment->method ?? 'N/A' }}</dd>
          </div>
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Reference</dt>
            <dd>{{ $payment->reference_no ?? 'N/A' }}</dd>
          </div>
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Status</dt>
            <dd class="font-semibold text-slate-900">{{ $payment->status }}</dd>
          </div>
          <div class="flex justify-between gap-6">
            <dt class="font-medium text-slate-500">Collected By</dt>
            <dd>{{ $collectorName }}</dd>
          </div>
        </dl>
      </div>

      <footer class="mt-8 border-t border-dashed border-slate-300 pt-6 text-center text-xs uppercase tracking-wider text-slate-400">
        {{ $committeeName }} &mdash; Thank you for staying current with your contributions.
      </footer>
    </div>
  </section>
</div>
@endsection
