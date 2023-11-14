<x-admin-layout>

    <x-slot name="title">
        Admin Dashboard
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- <div class="mb-4"> --}}
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                            {{ __('My Roles') }}
                        </h3>
                        <div class="mt-2 max-w-xl text-sm text-gray-500 dark:text-gray-400">
                            <p>
                                {{ __('You have the following roles assigned to you:') }}
                            </p>
                        </div>
                        <div class="mt-3 flex flex-wrap">
                            @foreach (Auth::user()->roles as $role)
                                <div
                                    class="bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-200 mr-2 mb-2">
                                    {{ $role->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
