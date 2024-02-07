<div class="format lg:format-lg">
    <div class="col-span-6 sm:col-span-4 mt-2">
        <x-label for="name" value="{{ __('Name') }}" />
        <x-p>{{ Str::of(data_get($state, 'name'))->title()->replace('-', ' ')->toString() }}</x-p>
    </div>

    <div class="col-span-6 sm:col-span-4 mt-2">
        <x-label for="description" value="{{ __('Description') }}" />
        <x-p>{{ data_get($state, 'description') }}</x-p>
    </div>
</div>
