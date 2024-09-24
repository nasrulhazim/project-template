<div class="bg-white  mx-8 py-4 px-8 rounded shadow-sm">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
            <h2
                class="text-2xl font-semibold cursor-pointer hover:text-slate-900 leading-7 text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
                Audit for <span class="">{{ str(class_basename($audit->auditable_type))->headline() }}</span>
                <x-badge :type="$audit->event" :label="strtoupper($audit->event)" x-data x-tooltip="Event" />
            </h2>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500 hover:text-slate-900 cursor-pointer" x-data
                    x-tooltip="IP Address">
                    <x-icon name="o-map" class="w-4 h-4 mr-2 text-slate-700"></x-icon>
                    {{ $audit->ip_address }}
                </div>
            </div>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500 hover:text-slate-900 cursor-pointer" x-data
                    x-tooltip="URL">
                    <x-icon name="o-link" class="w-4 h-4 mr-2 text-slate-700"></x-icon>
                    <span class="text-indigo-700">{{ $audit->url }}</span>
                </div>
            </div>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500 hover:text-slate-900 cursor-pointer" x-data
                    x-tooltip="Browser">
                    <x-icon name="o-desktop-computer" class="w-4 h-4 mr-2 text-slate-700"></x-icon>
                    {{ $audit->user_agent }}
                </div>
            </div>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500 hover:text-slate-900 cursor-pointer" x-data
                    x-tooltip="Event Recorded Date & Time">
                    <x-icon name="o-clock" class="w-4 h-4 mr-2 text-slate-700"></x-icon>
                    {{ $audit->created_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
        </div>
        @if ($audit->user)
            <div class="flex-row text-right " x-data x-tooltip="Changes made by {{ $audit->user->name }}">
                <div class="mb-2 flex justify-center justify-items-center">
                    <x-avatar class="h-10 w-10 text-2xl" :name="$audit->user->name" />
                </div>
                <div class="text-center">
                    <span class="text-sm text-slate-700">{{ $audit->user->name }}</span>
                    <br>
                    <span class="text-xs text-slate-700 italic">{{ $audit->user->email }}</span>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="bg-white  mx-8 py-4 px-8 rounded shadow-sm mt-8">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
            <h2
                class="text-2xl font-semibold cursor-pointer hover:text-slate-900 leading-7 text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
                Before
            </h2>
        </div>
    </div>

    @include('security.audit-trail.partials.table', ['values' => $audit->old_values])
</div>

<div class="bg-white  mx-8 py-4 px-8 rounded shadow-sm mt-8">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
            <h2
                class="text-2xl font-semibold cursor-pointer hover:text-slate-900 leading-7 text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
                After
            </h2>
        </div>
    </div>

    @include('security.audit-trail.partials.table', ['values' => $audit->new_values])
</div>
