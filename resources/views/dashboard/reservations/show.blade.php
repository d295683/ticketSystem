<x-app-layout>

    <x-slot name="title">
        Reservation Details
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservation Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-center mb-4">
                        <img class="w-full rounded-lg" src="{{ $event->image_url }}" alt="Event Image">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <h2 class="text-2xl font-bold">{{ $event->title }}</h2>
                            <div class="mt-4">
                                {!! $event->description !!}
                            </div>
                            <div class="mt-4">
                                <p><strong>Location:</strong> {{ $event->location }}</p>
                                <p><strong>Date:</strong> {{ Carbon\Carbon::parse($event->datetime)->format('d-m-Y') }}
                                </p>
                                <p><strong>Time:</strong> {{ Carbon\Carbon::parse($event->datetime)->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <h2 class="text-2xl font-bold">
                                    Tickets ({{ $tickets->total() }})
                                </h2>
                                <a href="{{ route('dashboard.reservations.tickets.index', ['reservation' => $reservation]) }}"
                                    class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Download</a>
                            </div>

                            <table class="mt-4 min-w-full divide-y divide-gray-600 overflow-hidden">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th
                                            class="w-3/4 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                            Ticket
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-600">
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td class="w-3/4 px-6 py-4 whitespace-nowrap">
                                                Ticket {{ $ticket->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('dashboard.reservations.tickets.show', ['reservation' => $reservation, 'ticket' => $ticket]) }}"
                                                    class="text-blue-600 hover:text-blue-900">View Ticket</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4">
                                {{ $tickets->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
