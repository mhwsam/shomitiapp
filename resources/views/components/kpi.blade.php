@props(['label','value','sublabel'=>null])
<div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
  <span class="text-sm font-medium text-slate-600">{{ $label }}</span>
  <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $value }}</p>
  @if($sublabel)
    <p class="mt-2 text-sm text-slate-500">{{ $sublabel }}</p>
  @endif
</div>
