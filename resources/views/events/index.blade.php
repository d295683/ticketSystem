<x-app-layout>
    <x-slot name="title">
        Upcoming events
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upcoming events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="flex flex-col items-center gap-3 text-white p-4 mb-4 rounded">
                        @foreach ($events as $year => $yearEvents)
                            <h2>{{ $year }}</h2>
                            @foreach ($yearEvents as $event)
                                <a href="{{ route('events.show', $event->id) }}"
                                    class="flex flex-col items-center md:flex-row bg-gray-600 text-white p-4 w-full rounded-md hover:scale-105 transition-transform duration-300">
                                    <div
                                        class="w-16 h-16 rounded bg-gray-700 flex flex-col items-center justify-center mb-4 md:mb-0 md:mr-4">
                                        <div class="text-2xl font-bold mb-1">
                                            {{ Carbon\Carbon::parse($event->datetime)->format('d') }}
                                        </div>
                                        <div class="text-sm text-gray-300">
                                            {{ Carbon\Carbon::parse($event->datetime)->format('M') }}
                                        </div>
                                    </div>
                                    <div class="w-full max-w-[75%] md:w-auto md:flex-grow md:mr-4">
                                        <div class="text-center md:text-left">
                                            <h2 class="text-2xl font-bold text-gray-100">{{ $event->title }}</h2>
                                            {{-- <p class="text-md text-gray-250">
                                                {{ Str::limit(strip_tags($event->description), 100) }}
                                            </p> --}}
                                            <p class="text-md text-gray-400">Time:
                                                {{ Carbon\Carbon::parse($event->datetime)->format('H:i') }}</p>
                                            <p class="text-md text-gray-400">Location: {{ $event->location }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full md:w-auto md:flex-grow mt-4 md:mt-0 flex  justify-center md:justify-end">
                                        <div class="flex flex-col gap-3 justify-between items-center">
                                            <span
                                                class="text-2xl font-bold text-gray-100 mr-4">&euro;{{ $event->price }}</span>
                                            <span class="text-2xl font-bold text-gray-400">
                                                {{ $event->tickets - $event->tickets_sold }} left</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            @if (!$loop->last)
                                <div class="w-full h-1 bg-gray-700 rounded-lg my-4"></div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
