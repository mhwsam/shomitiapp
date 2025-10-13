{{-- Replace the inside of <main> with YOUR provided HTML template.
     Use the $member variables to fill fields. --}}
<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Print Member Form — {{ $member->member_no }}</title>
  @vite(['resources/css/app.css'])
  <style>
    @media print {
      .no-print { display:none !important; }
      .page-break { page-break-after:always; }
    }
  </style>
</head>
<body class="bg-white">
  <div class="no-print p-4 border-b bg-gray-50">
    <a href="{{ url()->previous() }}" class="rounded-lg border px-3 py-2 text-sm hover:bg-gray-100">Back</a>
    <button onclick="window.print()" class="ml-2 rounded-lg bg-blue-600 px-3 py-2 text-sm text-white hover:bg-blue-700">Print</button>
  </div>

  <main class="mx-auto max-w-3xl p-6">
    {{-- EXAMPLE placeholder layout. Replace with your exact HTML. --}}
    <h1 class="text-center text-xl font-semibold mb-4">সদস্য আবেদন ফর্ম</h1>

    <div class="grid grid-cols-1 gap-3 text-sm">
      <div class="grid grid-cols-3 gap-2">
        <div><span class="text-gray-500">Member No:</span> <span class="font-medium">{{ $member->member_no }}</span></div>
        <div><span class="text-gray-500">Join Date:</span> <span class="font-medium">{{ $member->join_date }}</span></div>
        <div><span class="text-gray-500">Status:</span> <span class="font-medium">{{ ucfirst($member->status) }}</span></div>
      </div>
      <div><span class="text-gray-500">নাম (বাংলা):</span> <span class="font-medium">{{ $member->full_name_bn }}</span></div>
      <div><span class="text-gray-500">Mobile:</span> <span class="font-medium">{{ $member->mobile }}</span></div>
      <div><span class="text-gray-500">ঠিকানা:</span> <span class="font-medium">{{ $member->present_address }}</span></div>
    </div>

    {{-- Add your full table/fields here --}}
  </main>
</body>
</html>
