@props(['label','value','sublabel'=>null])
<div class="rounded-2xl border bg-white p-4 shadow-sm">
  <p class="text-sm text-gray-500">{{ $label }}</p>
  <p class="mt-2 text-2xl font-semibold tracking-tight">{{ $value }}</p>
  @if($sublabel)
    <p class="mt-1 text-xs text-gray-500">{{ $sublabel }}</p>
  @endif
</div>
