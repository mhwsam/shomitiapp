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
      <a href="{{ route('members.details',$member) }}" class="btn-outline">View Details</a>
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
        <div class="space-y-1 sm:col-span-2">
          <dt class="text-sm font-semibold text-slate-600">Nominee Photo</dt>
          <dd class="text-base font-medium text-slate-700">
            @if($member->nominee_photo_path)
              <img src="{{ asset('storage/'.$member->nominee_photo_path) }}" alt="{{ $member->nominee_name ?? 'Nominee photo' }}" class="h-24 w-24 rounded-xl border border-slate-200 object-cover shadow-sm">
            @else
              <span class="text-sm text-slate-500">Not provided</span>
            @endif
          </dd>
        </div>
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

  <section class="surface-panel space-y-6 p-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
      <div>
        <h2 class="text-lg font-semibold text-slate-900">Payment Activity</h2>
        <p class="text-sm text-slate-500">Review this member's transactions by month or by year.</p>
      </div>
      <a href="{{ route('members.show', $member) }}" class="btn-outline text-sm">Reset filters</a>
    </div>

    <form method="get" action="{{ route('members.show', $member) }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div class="flex flex-col gap-1">
        <label for="view" class="text-sm font-semibold text-slate-600">View</label>
        <select id="view" name="view" onchange="this.form.submit()">
          <option value="monthly" @selected($viewMode === 'monthly')>Monthly</option>
          <option value="yearly" @selected($viewMode === 'yearly')>Yearly</option>
        </select>
      </div>
      <div class="flex flex-col gap-1">
        <label for="year" class="text-sm font-semibold text-slate-600">Year</label>
        <select id="year" name="year" onchange="this.form.submit()">
          <option value="">All years</option>
          @foreach($availableYears as $year)
            <option value="{{ $year }}" @selected($yearFilter === (int) $year)>{{ $year }}</option>
          @endforeach
        </select>
      </div>
      <div class="flex flex-col gap-1">
        <label for="month" class="text-sm font-semibold text-slate-600">Month</label>
        <select id="month" name="month" @disabled($viewMode === 'yearly') onchange="this.form.submit()">
          <option value="">All months</option>
          @foreach($monthOptions as $value => $label)
            <option value="{{ $value }}" @selected($monthFilter === (int) $value)>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="flex items-end">
        <button type="submit" class="btn-primary w-full">Apply filters</button>
      </div>
    </form>

    @if($viewMode === 'yearly')
      @if($payments->count())
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
              <tr>
                <th scope="col" class="px-3 py-3">Year</th>
                <th scope="col" class="px-3 py-3">Collections</th>
                <th scope="col" class="px-3 py-3">Total Due</th>
                <th scope="col" class="px-3 py-3">Total Paid</th>
                <th scope="col" class="px-3 py-3">Outstanding</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
              @foreach($payments as $payment)
                <tr>
                  <td class="px-3 py-3 font-semibold text-slate-900">{{ $payment->year }}</td>
                  <td class="px-3 py-3">{{ number_format($payment->payments_count) }}</td>
                  <td class="px-3 py-3">{{ number_format($payment->total_due) }}</td>
                  <td class="px-3 py-3 text-emerald-600">{{ number_format($payment->total_paid) }}</td>
                  <td class="px-3 py-3 text-red-600">{{ number_format(max((int) $payment->total_due - (int) $payment->total_paid, 0)) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ $payments->links() }}
      @else
        <p class="text-sm text-slate-500">No payments recorded for the selected filters.</p>
      @endif
    @else
      @if($payments->count())
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
              <tr>
                <th scope="col" class="px-3 py-3">Period</th>
                <th scope="col" class="px-3 py-3">Amount Due</th>
                <th scope="col" class="px-3 py-3">Amount Paid</th>
                <th scope="col" class="px-3 py-3">Status</th>
                <th scope="col" class="px-3 py-3">Paid On</th>
                <th scope="col" class="px-3 py-3">Method</th>
                <th scope="col" class="px-3 py-3">Reference</th>
                <th scope="col" class="px-3 py-3">Collected By</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
              @foreach($payments as $payment)
                <tr>
                  <td class="px-3 py-3 font-semibold text-slate-900">
                    {{ \Carbon\Carbon::create($payment->year, $payment->month, 1)->format('F Y') }}
                  </td>
                  <td class="px-3 py-3">{{ number_format($payment->amount_due) }}</td>
                  <td class="px-3 py-3 text-emerald-600">{{ number_format($payment->amount_paid) }}</td>
                  <td class="px-3 py-3">
                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold uppercase {{ $payment->status === 'PAID' ? 'bg-emerald-100 text-emerald-700' : ($payment->status === 'PARTIAL' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                      {{ $payment->status }}
                    </span>
                  </td>
                  <td class="px-3 py-3">
                    {{ $payment->paid_on ? $payment->paid_on->timezone(config('app.timezone'))->format('d M Y h:i A') : 'N/A' }}
                  </td>
                  <td class="px-3 py-3">{{ $payment->method ?: 'N/A' }}</td>
                  <td class="px-3 py-3">{{ $payment->reference_no ?: 'N/A' }}</td>
                  <td class="px-3 py-3">{{ optional($payment->collector)->name ?: 'N/A' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ $payments->links() }}
      @else
        <p class="text-sm text-slate-500">No transactions found for the selected filters.</p>
      @endif
    @endif
  </section>
</div>
@endsection
