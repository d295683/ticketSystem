<x-admin-layout>

    <x-slot name="title">
        Manage Events
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="text-right mb-4">
                        <a href="{{ route('admin.events.create') }}"
                            class="bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded">Create Event</a>
                    </div>

                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Title
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Location
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Date & Time
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Price (EUR)
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Tickets Sold
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Tickets Available
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-600">

                                @foreach ($events as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->location }}</td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ Carbon\Carbon::parse($event->datetime)->format('d-m-Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->ticketsSold() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $event->ticketsLeft() }}/{{ $event->tickets }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('admin.events.edit', $event) }}"
                                                class="text-indigo-400 hover:text-indigo-600">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $events->links('vendor.pagination.custom') }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    </x-app-layout>
