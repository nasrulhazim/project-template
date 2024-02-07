<div>
    <div class="mx-auto sm:px-6 lg:px-8 sm:max-w-3xl max-w-5xl ">
        <div {{ $attributes->merge(['class' => 'bg-white rounded-md shadow-md p-4']) }}>
            {{ $slot }}
        </div>
    </div>
</div>
