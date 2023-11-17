<x-app-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div x-data="{ openPanel: 'Toekomstig' }">
                        @foreach ($reservationsByStatus as $status => $reservations)
                            <div class="border-b border-gray-200 mb-4 pb-4">
                                <button
                                    @click="openPanel = openPanel === '{{ $status }}' ? null : '{{ $status }}'"
                                    class="w-full px-4 py-2 text-left">
                                    <h2 class="font-semibold text-xl">{{ $status }} ({{ count($reservations) }})
                                    </h2>
                                </button>
                                <div x-show="openPanel === '{{ $status }}'" class="px-4 pb-2">
                                    <table class="min-w-full divide-y divide-gray-600 overflow-hidden">
                                        <thead class="bg-gray-700">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                                    Event
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                                    Tickets
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                                    Total
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
                                                    <td class="hidden">
                                                        @foreach ($reservation->tickets as $ticket)
                                                            {{ $ticket->code }},
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $reservation->event->title }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ Carbon\Carbon::parse($reservation->event->datetime)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $reservation->tickets->count() }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        &euro;{{ $reservation->tickets->count() * $reservation->event->price }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                            {{-- show reservation (dashboard.reservations) --}}
                                                            <a href="{{ route('dashboard.reservations.show', $reservation) }}"
                                                                class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
