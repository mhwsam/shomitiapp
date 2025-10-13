@extends('layouts.app')

@section('content')
<div class="space-y-8">
  <section>
    <span class="badge">New Member</span>
    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Add Member</h1>
    <p class="mt-2 max-w-2xl text-sm text-slate-600">Capture essential member information to keep your cooperative directory up to date.</p>
  </section>

  <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <section class="surface-panel p-6 sm:p-8 space-y-6">
      <div>
        <h2 class="text-lg font-semibold text-slate-900">Personal Details</h2>
        <p class="text-sm text-slate-500">Primary identification information about the member.</p>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="space-y-2 sm:col-span-2">
          <label for="full_name_bn">Full Name (Bangla)</label>
          <input id="full_name_bn" name="full_name_bn" value="{{ old('full_name_bn') }}" required placeholder="পূর্ণ নাম লিখুন">
        </div>
        <div class="space-y-2">
          <label for="full_name_en">Full Name (English)</label>
          <input id="full_name_en" name="full_name_en" value="{{ old('full_name_en') }}" placeholder="English name">
        </div>
        <div class="space-y-2">
          <label for="father_name">Father's Name</label>
          <input id="father_name" name="father_name" value="{{ old('father_name') }}">
        </div>
        <div class="space-y-2">
          <label for="mother_name">Mother's Name</label>
          <input id="mother_name" name="mother_name" value="{{ old('mother_name') }}">
        </div>
        <div class="space-y-2">
          <label for="spouse_name">Spouse Name</label>
          <input id="spouse_name" name="spouse_name" value="{{ old('spouse_name') }}">
        </div>
        <div class="space-y-2">
          <label for="gender">Gender</label>
          <select id="gender" name="gender">
            <option value="">Select gender</option>
            @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $value => $label)
              <option value="{{ $value }}" @selected(old('gender') === $value)>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-2">
          <label for="dob">Date of Birth</label>
          <input id="dob" type="date" name="dob" value="{{ old('dob') }}">
        </div>
        <div class="space-y-2">
          <label for="nid_no">NID / Identification No.</label>
          <input id="nid_no" name="nid_no" value="{{ old('nid_no') }}">
        </div>
      </div>
    </section>

    <section class="surface-panel p-6 sm:p-8 space-y-6">
      <div>
        <h2 class="text-lg font-semibold text-slate-900">Contact Information</h2>
        <p class="text-sm text-slate-500">How we can reach the member.</p>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="space-y-2">
          <label for="mobile">Mobile *</label>
          <input id="mobile" name="mobile" value="{{ old('mobile') }}" required placeholder="01XXXXXXXXX">
        </div>
        <div class="space-y-2">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="occupation">Occupation</label>
          <input id="occupation" name="occupation" value="{{ old('occupation') }}">
        </div>
      </div>
    </section>

    <section class="surface-panel p-6 sm:p-8 space-y-6">
      <div>
        <h2 class="text-lg font-semibold text-slate-900">Address</h2>
        <p class="text-sm text-slate-500">Residential details for correspondence.</p>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="space-y-2 sm:col-span-2">
          <label for="present_address">Present Address</label>
          <textarea id="present_address" name="present_address" rows="3" placeholder="Street, area, district">{{ old('present_address') }}</textarea>
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="permanent_address">Permanent Address</label>
          <textarea id="permanent_address" name="permanent_address" rows="3" placeholder="Village/Town, Upazila, District">{{ old('permanent_address') }}</textarea>
        </div>
        <div class="space-y-2">
          <label for="ward">Ward</label>
          <input id="ward" name="ward" value="{{ old('ward') }}">
        </div>
        <div class="space-y-2">
          <label for="post_office">Post Office</label>
          <input id="post_office" name="post_office" value="{{ old('post_office') }}">
        </div>
        <div class="space-y-2">
          <label for="thana">Thana / Upazila</label>
          <input id="thana" name="thana" value="{{ old('thana') }}">
        </div>
        <div class="space-y-2">
          <label for="district">District</label>
          <input id="district" name="district" value="{{ old('district') }}">
        </div>
        <div class="space-y-2">
          <label for="postal_code">Postal Code</label>
          <input id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
        </div>
      </div>
    </section>

    <section class="surface-panel p-6 sm:p-8 space-y-6">
      <div>
        <h2 class="text-lg font-semibold text-slate-900">Membership Details</h2>
        <p class="text-sm text-slate-500">Internal tracking information for the cooperative.</p>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="space-y-2">
          <label for="join_date">Join Date</label>
          <input id="join_date" type="date" name="join_date" value="{{ old('join_date') }}">
        </div>
        <div class="space-y-2">
          <label for="status">Status</label>
          <select id="status" name="status">
            <option value="">Select status</option>
            @foreach(['active' => 'Active', 'inactive' => 'Inactive'] as $value => $label)
              <option value="{{ $value }}" @selected(old('status') === $value)>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="remarks">Remarks</label>
          <textarea id="remarks" name="remarks" rows="3" placeholder="Additional notes (optional)">{{ old('remarks') }}</textarea>
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="photo">Photo</label>
          <input id="photo" type="file" name="photo" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-100 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:border-blue-400 hover:file:bg-blue-700">
        </div>
      </div>
    </section>

    <div class="flex flex-wrap gap-3">
      <button class="btn-primary">Save Member</button>
      <a href="{{ route('members.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
