@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section>
    <span class="badge">New Member</span>
    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Add Member</h1>
    <p class="mt-2 max-w-2xl text-sm text-slate-500">Capture essential member information to keep your cooperative directory up to date.</p>
  </section>

  <section class="surface-panel p-6 sm:p-8">
    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="grid gap-6 sm:grid-cols-2">
      @csrf

      <div class="space-y-2 sm:col-span-2">
        <label for="full_name_bn">Full Name (Bangla)</label>
        <input id="full_name_bn" name="full_name_bn" value="{{ old('full_name_bn') }}" required placeholder="পূর্ণ নাম লিখুন">
      </div>

      <div class="space-y-2">
        <label for="mobile">Mobile</label>
        <input id="mobile" name="mobile" value="{{ old('mobile') }}" required placeholder="01XXXXXXXXX">
      </div>

      <div class="space-y-2">
        <label for="email">Email (optional)</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
      </div>

      <div class="space-y-2 sm:col-span-2">
        <label for="present_address">Present Address</label>
        <textarea id="present_address" name="present_address" rows="3" placeholder="Street, area, district">{{ old('present_address') }}</textarea>
      </div>

      <div class="space-y-2">
        <label for="join_date">Join Date</label>
        <input id="join_date" type="date" name="join_date" value="{{ old('join_date') }}">
      </div>

      <div class="space-y-2">
        <label for="photo">Photo</label>
        <input id="photo" type="file" name="photo" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-100 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:border-blue-400 hover:file:bg-blue-700">
      </div>

      <div class="sm:col-span-2 flex flex-wrap gap-3">
        <button class="btn-primary">Save Member</button>
        <a href="{{ route('members.index') }}" class="btn-outline">Cancel</a>
      </div>
    </form>
  </section>
</div>
@endsection
