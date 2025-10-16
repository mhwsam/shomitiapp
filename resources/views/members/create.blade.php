@php($wrapContent = false)
@extends('layouts.app')

@section('content')
<div class="space-y-12">
<header class="rounded-2xl bg-white px-8 py-10 shadow-sm ring-1 ring-slate-200">
  <div class="mx-auto flex max-w-5xl flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
    <div class="space-y-3">
   
      <h1 class="text-3xl font-semibold leading-snug text-slate-900 sm:text-4xl">
        নতুন মেম্বার যুক্ত করুন
      </h1>
      <p class="max-w-2xl text-sm text-slate-600">
        Collect the essential personal, contact, and nominee information so your cooperative records stay accurate and ready for reporting.
      </p>
    </div>

    <div class="flex flex-col items-start gap-2 rounded-xl bg-slate-50 px-4 py-3 text-sm ring-1 ring-slate-200 lg:items-end">
      <span class="text-slate-600">Today's Date</span>
      <span class="text-lg font-semibold text-slate-900">{{ now()->format('d M Y') }}</span>
    </div>
  </div>
</header>


  <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="mx-auto max-w-5xl space-y-10">
    @csrf

    <section class="surface-panel p-6 sm:p-8">
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Personal Information</h2>
          <p class="text-sm text-slate-500">Primary identification for the member.</p>
        </div>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="sm:col-span-2 space-y-2">
          <label for="full_name_bn">Full Name (Bangla)</label>
          <input id="full_name_bn" name="full_name_bn" value="{{ old('full_name_bn') }}" required placeholder="এই সদস্যের পুরো নাম লিখুন">
        </div>
        <div class="space-y-2">
          <label for="full_name_en">Full Name (English)</label>
          <input id="full_name_en" name="full_name_en" value="{{ old('full_name_en') }}" placeholder="e.g. Rahim Uddin">
        </div>
        <div class="space-y-2">
          <label for="father_name">Father&apos;s Name</label>
          <input id="father_name" name="father_name" value="{{ old('father_name') }}">
        </div>
        <div class="space-y-2">
          <label for="mother_name">Mother&apos;s Name</label>
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
        <div class="space-y-2">
          <label for="institution_name">Prothisthan er Naam</label>
          <input id="institution_name" name="institution_name" value="{{ old('institution_name') }}" placeholder="Institution / workplace name">
        </div>
        <div class="space-y-2">
          <label for="religion">Religion</label>
          <input id="religion" name="religion" value="{{ old('religion') }}">
        </div>
        <div class="space-y-2">
          <label for="nationality">Nationality</label>
          <input id="nationality" name="nationality" value="{{ old('nationality') }}">
        </div>
        <div class="space-y-2">
          <label for="blood_group">Blood Group</label>
          <input id="blood_group" name="blood_group" value="{{ old('blood_group') }}">
        </div>
      </div>
    </section>

    <section class="surface-panel p-6 sm:p-8">
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Contact &amp; Address</h2>
          <p class="text-sm text-slate-500">How we will reach and locate the member.</p>
        </div>
      </div>
      <div class="grid gap-6 lg:grid-cols-2">
        <div class="space-y-2">
          <label for="mobile">Mobile *</label>
          <input id="mobile" name="mobile" value="{{ old('mobile') }}" required placeholder="01XXXXXXXXX">
        </div>
        <div class="space-y-2">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
        </div>
        <div class="space-y-2 lg:col-span-2">
          <label for="occupation">Occupation</label>
          <input id="occupation" name="occupation" value="{{ old('occupation') }}">
        </div>
        <div class="space-y-2 lg:col-span-2">
          <label for="present_address">Present Address</label>
          <textarea id="present_address" name="present_address" rows="3" placeholder="House, street, area">{{ old('present_address') }}</textarea>
        </div>
        <div class="space-y-2 lg:col-span-2">
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

    <section class="surface-panel p-6 sm:p-8">
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Nominee Details</h2>
          <p class="text-sm text-slate-500">Record beneficiary information for future reference.</p>
        </div>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="space-y-2">
          <label for="nominee_name">Nominee Name</label>
          <input id="nominee_name" name="nominee_name" value="{{ old('nominee_name') }}">
        </div>
        <div class="space-y-2">
          <label for="nominee_relation">Relation with the Nominee</label>
          <input id="nominee_relation" name="nominee_relation" value="{{ old('nominee_relation') }}">
        </div>
        <div class="space-y-2">
          <label for="nominee_nid">Nominee NID</label>
          <input id="nominee_nid" name="nominee_nid" value="{{ old('nominee_nid') }}">
        </div>
        <div class="space-y-2">
          <label for="nominee_religion">Nominee Religion</label>
          <input id="nominee_religion" name="nominee_religion" value="{{ old('nominee_religion') }}">
        </div>
        <div class="space-y-2">
          <label for="nominee_nationality">Nominee Nationality</label>
          <input id="nominee_nationality" name="nominee_nationality" value="{{ old('nominee_nationality') }}">
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="nominee_photo">Nominee Photo</label>
          <input id="nominee_photo" type="file" name="nominee_photo" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-100 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:border-blue-400 hover:file:bg-blue-700">
        </div>
      </div>
    </section>

    <section class="surface-panel p-6 sm:p-8">
      <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">Membership Details</h2>
          <p class="text-sm text-slate-500">Internal tracking fields for your records.</p>
        </div>
        <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
          Member No will be generated automatically
        </div>
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
          <textarea id="remarks" name="remarks" rows="3" placeholder="Anything you want to remember">{{ old('remarks') }}</textarea>
        </div>
        <div class="space-y-2 sm:col-span-2">
          <label for="photo">Photo</label>
          <input id="photo" type="file" name="photo" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-100 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:border-blue-400 hover:file:bg-blue-700">
        </div>
      </div>
    </section>

    <div class="flex flex-wrap justify-end gap-3">
      <a href="{{ route('members.index') }}" class="btn-outline">Cancel</a>
      <button class="btn-primary">Save Member</button>
    </div>
  </form>

  <footer class="mx-auto max-w-5xl rounded-3xl border border-dashed border-slate-300 bg-white/70 px-6 py-6 text-sm text-slate-600 shadow-sm">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
      <p class="font-medium text-slate-700">Need to onboard several members?</p>
      <p class="text-slate-500">Use the form above for single registrations or contact the admin team for bulk import support.</p>
    </div>
  </footer>
</div>
@endsection
