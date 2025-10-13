@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Edit Member</h1>

<form method="POST" action="{{ route('members.update',$member) }}" enctype="multipart/form-data" class="mt-4 grid gap-4 sm:grid-cols-2">
  @csrf @method('PUT')

  <div class="sm:col-span-2">
    <label class="block text-xs text-gray-600">Full Name (Bangla)</label>
    <input name="full_name_bn" required value="{{ old('full_name_bn',$member->full_name_bn) }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Mobile</label>
    <input name="mobile" required value="{{ old('mobile',$member->mobile) }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Email</label>
    <input type="email" name="email" value="{{ old('email',$member->email) }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div class="sm:col-span-2">
    <label class="block text-xs text-gray-600">Present Address</label>
    <textarea name="present_address" rows="2" class="mt-1 w-full rounded-xl border px-3 py-2">{{ old('present_address',$member->present_address) }}</textarea>
  </div>

  <div>
    <label class="block text-xs text-gray-600">Join Date</label>
    <input type="date" name="join_date" value="{{ old('join_date',$member->join_date) }}" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Photo</label>
    <input type="file" name="photo" accept="image/*" class="mt-1 w-full rounded-xl border px-3 py-2" />
    @if($member->photo_path)
      <img src="{{ asset('storage/'.$member->photo_path) }}" alt="" class="mt-2 h-16 w-16 rounded-lg object-cover">
    @endif
  </div>

  <div class="sm:col-span-2 flex gap-2">
    <button class="rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Update</button>
    <a href="{{ route('members.show',$member) }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Cancel</a>
  </div>
</form>
@endsection
