@php
    $edit = true;
    if (isset($row)) {
        $role = $row;
        $edit = false;
    }
@endphp
<div class="flex justify-between align-middle">
    <div class=" w-full max-w-full">
        <div class="font-semibold text-lg">
            {{ __($role->display_name) }}
        </div>
        <div class="mt-1 text-xs text-wrap text-gray-600 italic">
            {{ __(str($role->description)->toString()) }}
        </div>
    </div>
    <div class="flex justify-end">
        @can('update', $role)
            @if ($edit)
                <div x-data data-tippy-content="{{ __('Update Details for') }} {{ str($role->name)->headline() }} ">
                    @livewire('forms.access-control', [
                        'displayCreateRecord' => false,
                        'uuid' => $role->uuid,
                        'edit' => true,
                        'state' => [
                            'name' => $role->name,
                            'display_name' => $role->display_name,
                            'guard_name' => 'web',
                            'description' => $role->description,
                        ],
                    ])
                </div>
            @else
                <div>
                    <a class="cursor-pointer mr-4" x-data
                        data-tippy-content="{{ __('Manage permissions for') }} {{ str($role->name)->headline() }}"
                        href="{{ route('security.access-control.show', $role->uuid) }}">
                        <x-icon name="o-lock-open" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
                        </x-icon>
                    </a>
                </div>
            @endif
        @endcan

        <div class="flex justify-between">
            <div x-data
                data-tippy-content="{{ $role->is_enabled ? __('Disable') : __('Enable') }} {{ str($role->name)->headline() . ' ' . __('Role') }}">
                @livewire('toggle', [
                    'key' => 'role',
                    'field' => 'id',
                    'value' => $role->id,
                    'enabled' => $role->is_enabled,
                ])
            </div>
        </div>
    </div>

</div>
