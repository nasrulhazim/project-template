@props(['value' => true, 'label' => null])
<div class="inline-flex space-x-4 mx-2">
    <x-jet-checkbox value="{{ $value }}" {{ $attributes->merge(['class' => 'mt-1 inline-flex']) }} />
    @if($label)
        <span class=""> {{ __($label) }} </span>
    @endif
</div>
