@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <div>
      <span class="badge">Directory</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Members</h1>
      <p class="mt-2 text-sm text-slate-500">Maintain an up-to-date view of your cooperative members and their status.</p>
    </div>
    <a href="{{ route('members.create') }}" class="btn-primary self-start">Add Member</a>
  </section>

  <section class="surface-panel p-5 sm:p-6">
    <form method="GET" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
      <div class="w-full sm:max-w-xs space-y-2">
        <label for="q">Search</label>
        <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="Name, phone or member no.">
      </div>
      <div class="flex flex-wrap gap-3">
        <button class="btn-primary">Apply</button>
        <a href="{{ route('members.index') }}" class="btn-outline">Reset</a>
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
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @forelse($members as $m)
            <tr class="border-t border-slate-200 transition-colors duration-200 hover:bg-slate-100">
              <td class="px-6 py-4 font-semibold text-slate-900">{{ $m->member_no }}</td>
              <td class="px-6 py-4 text-slate-700">{{ $m->full_name_bn ?? $m->full_name_en }}</td>
              <td class="px-6 py-4 text-slate-600">{{ $m->mobile }}</td>
              <td class="px-6 py-4">
                <span class="inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold {{ $m->status=='active' ? 'border-emerald-200 bg-emerald-50 text-emerald-600' : 'border-slate-200 bg-slate-100 text-slate-600' }}">
                  {{ ucfirst($m->status ?? 'inactive') }}
                </span>
              </td>
              <td class="px-6 py-4 text-right">
                <div class="flex flex-wrap justify-end gap-4 text-sm font-semibold text-blue-600">
                  <a href="{{ route('members.show',$m) }}" class="hover:text-blue-700">View</a>
                  <a href="{{ route('members.edit',$m) }}" class="hover:text-blue-700">Edit</a>
                  <a href="{{ route('members.print',$m) }}" class="hover:text-blue-700">Print</a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">No members found for the provided filters.</td>
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
