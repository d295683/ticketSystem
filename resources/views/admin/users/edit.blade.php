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
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="name">Name</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="name" name="name" type="text" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="email">Email</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="email" name="email" type="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-4" x-data="{ open: false, search: '' }">
                            <span class="block text-sm font-medium text-gray-200">Roles</span>
                            <div @click="open = !open"
                                class="mt-1 block text-sm font-medium text-gray-200 cursor-pointer bg-gray-700 p-2 rounded-md">
                                Roles
                                <span x-show="!open" class="float-right">&plus;</span>
                                <span x-show="open" class="float-right">&minus;</span>
                            </div>

                            <div x-show="open" class="relative" @click.away="open = false">
                                <div
                                    class="absolute z-10 w-full bg-gray-700 rounded-md shadow-lg max-h-80 overflow-auto">
                                    <input type="text" x-model="search" placeholder="Search roles"
                                        class="mb-2 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200">
                                    @foreach ($roles as $role)
                                        <div class="m-2 p-2 border-2 border-gray-600 rounded-md bg-gray-700 text-gray-200 cursor-pointer"
                                            @click="selected = !selected; $event.target.classList.toggle('border-indigo-500')"
                                            x-data="{ selected: {{ (old('roles') ? in_array($role->id, old('roles')) : $user->roles->contains($role)) ? 'true' : 'false' }} }" x-bind:class="{ 'border-indigo-500': selected }"
                                            x-show="search === '' || '{{ $role->name }}'.toLowerCase().includes(search.toLowerCase())">
                                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                x-model="selected" class="hidden">
                                            {{ $role->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>

                            <button type="submit" form="delete-form"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Delete
                            </button>
                        </div>
                    </form>

                    {{-- delete form --}}
                    <form id="delete-form" method="POST" action="{{ route('admin.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
