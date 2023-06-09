<div class="bg-slate-50 hover:bg-slate-100 hover:border-slate-300 hover:rounded flex align-middle justify-between my-2 py-2 mx-4">
    <a href="{{ $url }}" class="text-sm text-indigo-700 ml-4" target="{{ $target ?? '_blank' }}">
        {{ $name ?? 'file' }}
    </a>
    {{ $slot }}
</div>
