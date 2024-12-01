<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-container class="mb-8">
            @include('security.users.partials.info')
        </x-container>

        <x-container class=" mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="md:col-span-1 flex justify-between mb-4 pb-4 border-b border-gray-200 ">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-md font-bold text-gray-900">Roles</h3>

                        <p class="mt-1 text-xs text-gray-600 italic">
                            {{ __('Update user roles') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4">
                @foreach ($roles as $role)
                    <div class="mb-4 col-span-3">
                        <p>{{ str($role->name)->headline() }}</p>
                        <p class="mt-1 text-xs text-gray-600 italic">{{ __($role->description) }}</p>
                    </div>

                    <div class="col-span-1 flex justify-center align-middle ml-8 pt-4" x-data
                        data-tippy-content="{{ __('Give or revoke access to this user') }}">
                        @livewire(
                            'security.toggle-user-role',
                            [
                                'uuid' => $user->uuid,
                                'role' => $role->name,
                            ],
                            key($user->uuid)
                        )
                    </div>
                @endforeach
            </div>
        </x-container>
    </div>


</x-app-layout>
