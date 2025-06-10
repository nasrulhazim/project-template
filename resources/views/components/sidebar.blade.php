<div class="flex flex-col h-full overflow-y-auto">
    <div class="flex-shrink-0 flex items-center justify-center h-16 bg-white">
        <x-logo />
    </div>
    <nav class="flex-1 px-2 py-4 space-y-1">
        @include('components.sidebar-menus', ['menus' => $menus])
    </nav>
</div>
