<div {{ $attributes->merge(['class' => 'max-w-full mx-auto overflow-hidden']) }}>
    @isset($header)
        <div class="border-b-2 border-b-slate-100 p-4">
            {{ $header }}
        </div>
    @endisset

    <div class="p-4">
        {{ $slot }}
    </div>
    
    @isset($footer)
        <div class="bg-slate-50 p-4">
            {{ $footer }}
        </div>
    @endisset
</div>