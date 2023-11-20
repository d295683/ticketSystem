<x-admin-layout>
    <x-slot name="title">
        Manage Reservations
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-scroll mb-4 overflow-visible">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Event
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Tickets Ordered
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-600">
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->event->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->tickets->count() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- <a href="{{ route('admin.reservations.tickets', $reservation) }}"
                                                class="text-indigo-400 hover:text-indigo-600">Show Tickets</a> --}}
                                            {{-- <span class="mx-2">|</span> --}}
                                            <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                                class="text-indigo-400 hover:text-indigo-600">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $reservations->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>

</x-admin-layout>
