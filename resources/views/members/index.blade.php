@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
  <h1 class="text-xl font-semibold">Members</h1>
  <a href="{{ route('members.create') }}" class="rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Add Member</a>
</div>

<form method="GET" class="mt-4 flex flex-wrap items-end gap-2">
  <div>
    <label class="block text-xs text-gray-600">Search</label>
    <input type="text" name="q" value="{{ request('q') }}"
           class="mt-1 w-64 rounded-xl border px-3 py-2" placeholder="Name, phone or member no.">
  </div>
  <button class="rounded-xl border px-4 py-2 hover:bg-gray-50">Apply</button>
  <a href="{{ route('members.index') }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Reset</a>
</form>

<div class="mt-4 overflow-x-auto rounded-2xl border bg-white">
  <table class="min-w-full text-sm">
    <thead class="bg-gray-50 text-left text-gray-600">
      <tr>
        <th class="px-4 py-3">Member No</th>
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Mobile</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody>
      @forelse($members as $m)
        <tr class="border-t">
          <td class="px-4 py-3 font-medium">{{ $m->member_no }}</td>
          <td class="px-4 py-3">{{ $m->full_name_bn ?? $m->full_name_en }}</td>
          <td class="px-4 py-3">{{ $m->mobile }}</td>
          <td class="px-4 py-3">
            <span class="rounded-lg px-2 py-1 text-xs {{ $m->status=='active' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-100 text-gray-600 border' }}">
              {{ ucfirst($m->status) }}
            </span>
          </td>
          <td class="px-4 py-3 text-right">
            <a href="{{ route('members.show',$m) }}" class="text-blue-600 hover:underline text-sm">View</a>
            <span class="mx-1 text-gray-300">|</span>
            <a href="{{ route('members.edit',$m) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
            <span class="mx-1 text-gray-300">|</span>
            <a href="{{ route('members.print',$m) }}" class="text-blue-600 hover:underline text-sm">Print</a>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">No members found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $members->links() }}</div>
@endsection
