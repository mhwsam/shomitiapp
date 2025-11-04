@extends('layouts.app')

@section('content')
@php
  $formatDate = function ($value) {
      if (!$value) {
          return null;
      }
      try {
          return \Illuminate\Support\Carbon::parse($value)->format('d M Y');
      } catch (\Throwable $e) {
          return $value;
      }
  };

  $detailSections = [
      'Personal Information' => [
          ['label' => 'Full Name (Bangla)', 'value' => $member->full_name_bn],
          ['label' => 'Full Name (English)', 'value' => $member->full_name_en],
          ['label' => 'Father\'s Name', 'value' => $member->father_name],
          ['label' => 'Mother\'s Name', 'value' => $member->mother_name],
          ['label' => 'Spouse Name', 'value' => $member->spouse_name],
          ['label' => 'Gender', 'value' => $member->gender ? ucfirst($member->gender) : null],
          ['label' => 'Date of Birth', 'value' => $formatDate($member->dob)],
          ['label' => 'Blood Group', 'value' => $member->blood_group ? \Illuminate\Support\Str::upper($member->blood_group) : null],
          ['label' => 'Prothisthan er Naam', 'value' => $member->institution_name],
          ['label' => 'Religion', 'value' => $member->religion],
          ['label' => 'Nationality', 'value' => $member->nationality],
          ['label' => 'NID / Identification No.', 'value' => $member->nid_no],
      ],
      'Contact & Address' => [
          ['label' => 'Mobile', 'value' => $member->mobile],
          ['label' => 'Email', 'value' => $member->email],
          ['label' => 'Occupation', 'value' => $member->occupation],
          ['label' => 'Present Address', 'value' => $member->present_address],
          ['label' => 'Permanent Address', 'value' => $member->permanent_address],
      ],
      'Membership' => [
          ['label' => 'Member No', 'value' => $member->member_no],
          ['label' => 'Join Date', 'value' => $formatDate($member->join_date)],
          ['label' => 'Status', 'value' => $member->status ? ucfirst($member->status) : null],
          ['label' => 'Remarks', 'value' => $member->remarks ? nl2br(e($member->remarks)) : null, 'asHtml' => true],
      ],
      'Nominee Details' => [
          ['label' => 'Nominee Name', 'value' => $member->nominee_name],
          ['label' => 'Relation with the Nominee', 'value' => $member->nominee_relation],
          ['label' => 'Nominee NID', 'value' => $member->nominee_nid],
          ['label' => 'Nominee Religion', 'value' => $member->nominee_religion],
          ['label' => 'Nominee Nationality', 'value' => $member->nominee_nationality],
          ['label' => 'Nominee Photo', 'value' => $member->nominee_photo_path ? asset('storage/'.$member->nominee_photo_path) : null, 'isImage' => true],
      ],
  ];
@endphp

<div class="space-y-8">
  <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <div>
      <span class="badge">Member Details</span>
      <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $member->full_name_bn ?? $member->full_name_en }}</h1>
      <p class="mt-2 text-sm text-slate-500">Comprehensive profile overview for {{ $member->member_no }}.</p>
    </div>
    <div class="flex flex-wrap gap-3">
      <a href="{{ route('members.show',$member) }}" class="btn-outline">Back to Summary</a>
      <a href="{{ route('members.print',$member) }}" class="btn-primary" target="_blank" rel="noopener">Print Profile</a>
    </div>
  </section>

  <section class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
      @foreach($detailSections as $sectionTitle => $fields)
        <div class="surface-panel p-6">
          <h2 class="text-lg font-semibold text-slate-900">{{ $sectionTitle }}</h2>
          <dl class="mt-5 grid gap-x-6 gap-y-4 sm:grid-cols-2">
            @foreach($fields as $field)
              <div class="space-y-1">
                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $field['label'] }}</dt>
                <dd class="text-sm font-medium text-slate-800">
                @php $value = $field['value'] ?? null; @endphp
                @if(isset($field['asHtml']) && $field['asHtml'])
                  {!! $value ?? 'Not provided' !!}
                @elseif(!empty($field['isImage']))
                  @if($value)
                    <img src="{{ $value }}" alt="{{ $member->nominee_name ?? 'Nominee photo' }}" class="h-24 w-24 rounded-xl border border-slate-200 object-cover shadow-sm">
                  @else
                    <span class="text-slate-500">Not provided</span>
                  @endif
                @else
                  {{ $value ?? 'Not provided' }}
                @endif
                </dd>
              </div>
            @endforeach
          </dl>
        </div>
      @endforeach
    </div>
    <div class="surface-panel flex flex-col items-center gap-4 p-6 text-center">
      <div class="relative">
        <span class="absolute -right-3 -top-3 flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white shadow-sm">ID</span>
        @if($member->photo_path)
          <img src="{{ asset('storage/'.$member->photo_path) }}"
               alt="{{ $member->full_name_bn ?? 'Member photo' }}"
               class="mx-auto h-48 w-48 rounded-3xl object-cover shadow-lg shadow-slate-900/10">
        @else
          @php
            $initial = \Illuminate\Support\Str::of($member->full_name_bn ?? $member->full_name_en ?? 'M')->substr(0,1)->upper();
          @endphp
          <div class="mx-auto flex h-48 w-48 items-center justify-center rounded-3xl bg-slate-200 text-5xl font-semibold text-slate-600">
            {{ $initial }}
          </div>
        @endif
      </div>
      <div class="space-y-2 text-sm text-slate-600">
        <div class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-600">
          {{ ucfirst($member->status ?? 'inactive') }}
        </div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 text-left text-xs text-slate-500">
          <strong class="text-sm font-semibold text-slate-700">Quick Info</strong>
          <ul class="mt-2 space-y-1">
            <li><span class="font-semibold text-slate-600">Member No:</span> {{ $member->member_no }}</li>
            <li><span class="font-semibold text-slate-600">Join Date:</span> {{ $formatDate($member->join_date) ?? 'Not provided' }}</li>
            <li><span class="font-semibold text-slate-600">Mobile:</span> {{ $member->mobile ?? 'Not provided' }}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
