@if (session()->has('message'))
    @php
        $message = session('message');
        $parts = explode('|', $message, 2);
        $classType = json_decode($parts[0], JSON_OBJECT_AS_ARRAY) ?? [
            'border' => 'border-slate-500',
            'bg' => 'bg-slate-100',
            'text' => 'text-slate-500',
        ]; // Default class if no '|' is present
        $text = $parts[1] ?? $parts[0]; // If there's no '|', use the entire message as text
    @endphp

    <div class=" fixed bottom-4 md:bottom-8 left-0 right-0 mx-auto px-4 md:px-0 md:left-auto md:right-8 w-full md:w-2/6 z-100 transition duration-200"
        x-data="{ showToastr: true }" x-init="setTimeout(() => showToastr = false, 7500)">

        <div class="bg-white border {{ $classType['border'] }} shadow-md rounded-lg py-2.5 px-4 flex items-center"
            x-show="showToastr">
            <div class="{{ $classType['bg'] }} h-8 w-8 rounded-full inline-flex items-center justify-center mr-3">
                <x-icon name="o-exclamation-circle" class="{{ $classType['text'] }}"></x-icon>
            </div>
            <span>{{ $text }}</span>
            <x-icon x-on:click="showToastr = false" name="o-x"
                class="text-gray-500 p-1 w-6 h-6 ml-auto hover:text-gray-700 cursor-pointer"></x-icon>
        </div>
    </div>
@endif
