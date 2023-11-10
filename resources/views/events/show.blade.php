<x-app-layout>

    <x-slot name="title">
        Event details
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <img class="w-full rounded-lg mb-4" src="{{ $event->image }}" alt="Event Image">
                        <div class="flex justify-between">
                            <h2 class="text-2xl font-bold">{{ $event->title }}</h2>
                            <p class="text-2xl">&euro;{{ $event->price }}</p>
                        </div>
                        <p class="text-lg">{{ $event->tickets_available }} Tickets Available</p>
                    </div>
                    <div class="mt-4">
                        <p>{{ $event->description }}</p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <div>
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Date:</strong> {{ Carbon\Carbon::parse($event->datetime)->format('d-m-Y') }}</p>
                            <p><strong>Time:</strong> {{ Carbon\Carbon::parse($event->datetime)->format('H:i') }}</p>
                        </div>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Order Ticket
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
