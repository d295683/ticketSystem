<x-app-layout>

    <x-slot name="title">
        Order event tickets
    </x-slot>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order event tickets') }}
            </h2>
            <a href="{{ route('events.order', $event) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('events.reserve', $event) }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="mb-4">
                            <div class="flex flex-row items-center justify-center">

                                <div
                                    class="w-16 h-16 rounded bg-gray-700 flex flex-col items-center justify-center mr-4">
                                    <div class="text-2xl font-bold mb-1">
                                        {{ Carbon\Carbon::parse($event->datetime)->format('d') }}
                                    </div>
                                    <div class="text-sm text-gray-300">
                                        {{ Carbon\Carbon::parse($event->datetime)->format('M') }}
                                    </div>
                                </div>

                                <div class="max-w-[75%] w-auto flex-grow mr-4">
                                    <div class="text-left">
                                        <h2 class="text-2xl font-bold text-gray-100">{{ $event->title }}</h2>
                                        <p class="text-md text-gray-400">Time:
                                            {{ Carbon\Carbon::parse($event->datetime)->format('H:i') }}</p>
                                        <p class="text-md text-gray-400">Location: {{ $event->location }}</p>
                                    </div>
                                </div>

                                <div class="w-auto flex-grow mt-0 justify-end flex">
                                    <div class="flex flex-col gap-3 justify-between items-center">
                                        <span
                                            class="text-2xl font-bold text-gray-100 mr-4">&euro;{{ $event->price }}</span>
                                        <span class="text-2xl font-bold text-gray-400">
                                            {{ $event->ticketsLeft() . '/' . $event->tickets }} left
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="flex flex-col items-center justify-center" x-data="{ tickets: {{ old('tickets', 0) }}, ticketPrice: {{ $event->price }}, totalPrice: 0 }">
                                <div class="flex flex-row items-center justify-center mb-4">
                                    <button type="button"
                                        @click="tickets > 0 ? tickets-- : tickets = 0, totalPrice = (tickets * ticketPrice).toFixed(2)"
                                        class="bg-gray-700 text-gray-100 rounded-full w-8 h-8 flex items-center justify-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="mx-2 text-gray-100 text-xl" x-text="tickets"></span>
                                    <input type="hidden" x-model="tickets" name="tickets" id="tickets" min="0"
                                        max="{{ $event->tickets }}" value="0">
                                    <button type="button"
                                        @click="tickets < {{ $event->ticketsLeft() }} ? tickets++ : tickets = {{ $event->ticketsLeft() }}, totalPrice = (tickets * ticketPrice).toFixed(2)"
                                        class="bg-gray-700 text-gray-100 rounded-full w-8 h-8 flex items-center justify-center ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-between w-full items-center">
                                    <div>
                                        <p class="text-lg font-bold text-gray-100"
                                            x-text="'Total Price: &euro;' + totalPrice"></p>
                                        <p class="text-sm text-gray-400"
                                            x-text="tickets + ' x ' + ticketPrice + ' = &euro;' + totalPrice"></p>
                                    </div>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Confirm Reservation
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
