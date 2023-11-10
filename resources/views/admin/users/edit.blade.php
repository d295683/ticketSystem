<x-admin-layout>

    <x-slot name="title">
        Manage Users
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 text-gray-200">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="name">Name</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="name" name="name" type="text" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="email">Email</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="email" name="email" type="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-4" x-data="{ selectedRoles: [] }">
                            <label class="block text-sm font-medium text-gray-200" for="roles">Role(s)</label>
                            <x-dropdown align="top" width="0" contentClasses="overflow-scroll h-64 w-64">
                                <x-slot name="trigger">
                                    <span
                                        class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200 cursor-pointer"
                                        x-text="selectedRoles.length > 0 ? selectedRoles.join(', ') : 'Select roles'"></span>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach ($roles as $role)
                                        <div x-data="{ checked: false }" class="p-4 h-10 flex items-center" :class="{ 'border-l-4 pl-3': checked }">
                                            <input x-model="checked" class="hidden" type="checkbox"
                                                id="{{ $role->id }}"
                                                :checked="selectedRoles.includes('{{ $role->name }}')"
                                                @click="selectedRoles.includes('{{ $role->name }}') ? selectedRoles.splice(selectedRoles.indexOf('{{ $role->name }}'), 1) : selectedRoles.push('{{ $role->name }}')">
                                            <label
                                                for="{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>

                            <input type="hidden" name="roles" :value="selectedRoles" value="Selected roles">
                        </div>

                        <div>
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
