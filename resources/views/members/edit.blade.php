@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <span class="badge">Member Profile</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">Edit Member</h1>
      <p class="mt-2 max-w-2xl text-sm text-slate-500">Update details for {{ $member->full_name_bn ?? $member->full_name_en }} to keep records accurate.</p>
    </div>
    <a href="{{ route('members.show',$member) }}" class="btn-outline self-start">View Profile</a>
  </section>

  <section class="surface-panel p-6 sm:p-8">
    <form method="POST" action="{{ route('members.update',$member) }}" enctype="multipart/form-data" class="grid gap-6 sm:grid-cols-2">
      @csrf
      @method('PUT')

      <div class="space-y-2 sm:col-span-2">
        <label for="full_name_bn">Full Name (Bangla)</label>
        <input id="full_name_bn" name="full_name_bn" value="{{ old('full_name_bn',$member->full_name_bn) }}" required>
      </div>

      <div class="space-y-2">
        <label for="mobile">Mobile</label>
        <input id="mobile" name="mobile" value="{{ old('mobile',$member->mobile) }}" required>
      </div>

      <div class="space-y-2">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email',$member->email) }}">
      </div>

      <div class="space-y-2 sm:col-span-2">
        <label for="present_address">Present Address</label>
        <textarea id="present_address" name="present_address" rows="3">{{ old('present_address',$member->present_address) }}</textarea>
      </div>

      <div class="space-y-2">
        <label for="join_date">Join Date</label>
        <input id="join_date" type="date" name="join_date" value="{{ old('join_date', optional($member->join_date ? \Illuminate\Support\Carbon::parse($member->join_date) : null)->format('Y-m-d')) }}">
      </div>

      <div class="space-y-2">
        <label for="photo">Photo</label>
        <input id="photo" type="file" name="photo" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-100 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:border-blue-400 hover:file:bg-blue-700">
        @if($member->photo_path)
          <div class="mt-3 flex items-center gap-3 rounded-lg border border-slate-200 bg-white p-3">
            <img src="{{ asset('storage/'.$member->photo_path) }}" alt="{{ $member->full_name_bn ?? 'Member photo' }}" class="h-16 w-16 rounded-lg object-cover shadow-sm">
            <span class="text-sm text-slate-600">Current photo</span>
          </div>
        @endif
      </div>

      <div class="sm:col-span-2 flex flex-wrap gap-3">
        <button class="btn-primary">Update Member</button>
        <a href="{{ route('members.index') }}" class="btn-outline">Back to members</a>
      </div>
    </form>
  </section>
</div>
@endsection
