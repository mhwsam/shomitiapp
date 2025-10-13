@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold">Add Member</h1>

<form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="mt-4 grid gap-4 sm:grid-cols-2">
  @csrf

  <div class="sm:col-span-2">
    <label class="block text-xs text-gray-600">Full Name (Bangla)</label>
    <input name="full_name_bn" required class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Mobile</label>
    <input name="mobile" required class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Email (optional)</label>
    <input type="email" name="email" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div class="sm:col-span-2">
    <label class="block text-xs text-gray-600">Present Address</label>
    <textarea name="present_address" rows="2" class="mt-1 w-full rounded-xl border px-3 py-2"></textarea>
  </div>

  <div>
    <label class="block text-xs text-gray-600">Join Date</label>
    <input type="date" name="join_date" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div>
    <label class="block text-xs text-gray-600">Photo</label>
    <input type="file" name="photo" accept="image/*" class="mt-1 w-full rounded-xl border px-3 py-2" />
  </div>

  <div class="sm:col-span-2 flex gap-2">
    <button class="rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
    <a href="{{ route('members.index') }}" class="rounded-xl border px-4 py-2 hover:bg-gray-50">Cancel</a>
  </div>
</form>
@endsection
