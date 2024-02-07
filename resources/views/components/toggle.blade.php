<div>
    <div x-data="{ toggle : @entangle($status).live }" class="my-2">
        <x-label class="mb-1">{{ $label ?? 'Status' }}</x-label>
        <button type="button"
             x-on:click="toggle = ! toggle"
            x-bind:class="toggle ? 'bg-indigo-600' : 'bg-gray-200' "
            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
            role="switch" aria-checked="false">
            <span class="sr-only">{{ $label ?? 'Status' }}</span>
            <span aria-hidden="true"
                x-bind:class="toggle ? 'translate-x-5' : 'translate-x-0'"
                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
        </button>
    </div>
</div>
