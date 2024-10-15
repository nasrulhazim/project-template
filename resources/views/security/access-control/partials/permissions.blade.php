@foreach ($permissions as $module => $_permissions)
    @if (!empty($module))
        <div class="my-4">
            <div>
                <div class="md:col-span-1 flex justify-between mb-4">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-md font-medium text-gray-900">{{ __($module) }}</h3>

                        <p class="mt-1 text-xs text-gray-600 italic">
                            {{ __('Update Access Control for Module ').__($module) }}
                        </p>
                    </div>
                </div>
            </div>
            @php
                $functions = $_permissions->groupBy('function');
            @endphp
            <div class="bg-white rounded-md shadow-md p-4">
                <table class="table-fixed w-full">
                    <tr>
                        <th class="text-center">&nbsp;</th>
                        <th class="text-center">{{ __('View') }}</th>
                        <th class="text-center">{{ __('Create') }}</th>
                        <th class="text-center">{{ __('Update') }}</th>
                        <th class="text-center">{{ __('Delete') }}</th>
                    </tr>
                    @foreach ($functions as $function => $_permission)
                        @if (!empty($function))
                            @php
                                $view =
                                    'view-' .
                                    str($function)
                                        ->kebab()
                                        ->toString() .
                                    '-' .
                                    str($module)
                                        ->kebab()
                                        ->toString();
                                $create =
                                    'create-' .
                                    str($function)
                                        ->kebab()
                                        ->toString() .
                                    '-' .
                                    str($module)
                                        ->kebab()
                                        ->toString();
                                $update =
                                    'update-' .
                                    str($function)
                                        ->kebab()
                                        ->toString() .
                                    '-' .
                                    str($module)
                                        ->kebab()
                                        ->toString();
                                $delete =
                                    'delete-' .
                                    str($function)
                                        ->kebab()
                                        ->toString() .
                                    '-' .
                                    str($module)
                                        ->kebab()
                                        ->toString();
                            @endphp

                            <tr class="text-sm">
                                <td class="py-2 ml-4">
                                    <span>{{ __($function) }}</span>
                                </td>
                                <td class="py-2 text-center">
                                    @if ($_permission->where('name', $view)->count() > 0)
                                        @livewire('security.role-permission', [
                                            'role_id' => $role->id,
                                            'permission_name' => $view,
                                            'checked' => $role->hasPermissionTo($view),
                                        ])
                                    @endif
                                </td>
                                <td class="py-2 text-center">
                                    @if ($_permission->where('name', $create)->count() > 0)
                                        @livewire('security.role-permission', [
                                            'role_id' => $role->id,
                                            'permission_name' => $create,
                                            'checked' => $role->hasPermissionTo($create),
                                        ])
                                    @endif
                                </td>
                                <td class="py-2 text-center">
                                    @if ($_permission->where('name', $update)->count() > 0)
                                        @livewire('security.role-permission', [
                                            'role_id' => $role->id,
                                            'permission_name' => $update,
                                            'checked' => $role->hasPermissionTo($update),
                                        ])
                                    @endif
                                </td>
                                <td class="py-2 text-center">
                                    @if ($_permission->where('name', $delete)->count() > 0)
                                        @livewire('security.role-permission', [
                                            'role_id' => $role->id,
                                            'permission_name' => $delete,
                                            'checked' => $role->hasPermissionTo($delete),
                                        ])
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endforeach
