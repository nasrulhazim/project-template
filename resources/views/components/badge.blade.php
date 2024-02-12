@props(['type' => 'created', 'label' => 'Created'])
@php
    if(isset($row)) {
        $type = $row->event;
        $label = strtoupper($row->event);
    }

    $color = match($type) {
        'created' => 'fill-green-500',
        'updated' => 'fill-blue-500',
        'deleted' => 'fill-red-500',
    };
@endphp

<span class="inline-flex items-center gap-x-1.5  px-2 py-1 text-xs font-medium text-gray-900 ">
    <svg class="h-1.5 w-1.5 {{ $color ?? 'fill-red-500' }}" viewBox="0 0 6 6" aria-hidden="true">
      <circle cx="3" cy="3" r="3" />
    </svg>
    {{ $label ?? '' }}
</span>
