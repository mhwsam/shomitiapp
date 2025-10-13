@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
  <h1 class="text-xl font-semibold">Member: {{ $member->full_name_bn ?? $member->full_name_en }}</h1>
  <div class="flex gap-2">
    <a href="{{ route('members.edit',$member) }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Edit</a>
    <a href="{{ route('members.print',$member) }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Print</a>
  </div>
</div>

<div class="mt-4 grid gap-4 sm:grid-cols-3">
  <div class="sm:col-span-2 rounded-2xl border bg-white p-4">
    <dl class="grid grid-cols-1 gap-3 sm:grid-cols-2 text-sm">
      <div><dt class="text-gray-500">Member No</dt><dd class="font-medium">{{ $member->member_no }}</dd></div>
      <div><dt class="text-gray-500">Mobile</dt><dd class="font-medium">{{ $member->mobile }}</dd></div>
      <div class="sm:col-span-2"><dt class="text-gray-500">Address</dt><dd class="font-medium">{{ $member->present_address }}</dd></div>
      <div><dt class="text-gray-500">Status</dt><dd class="font-medium">{{ ucfirst($member->status) }}</dd></div>
      <div><dt class="text-gray-500">Join Date</dt><dd class="font-medium">{{ $member->join_date }}</dd></div>
    </dl>
  </div>

  <div class="rounded-2xl border bg-white p-4 text-center">
    @if($member->photo_path)
      <img src="{{ asset('storage/'.$member->photo_path) }}" class="mx-auto h-32 w-32 rounded-xl object-cover" />
    @else
      <div class="mx-auto h-32 w-32 rounded-xl bg-gray-100"></div>
    @endif
  </div>
</div>
@endsection
