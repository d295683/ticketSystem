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

                    <form method="POST" action="{{ route('admin.events.update', $event) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="title">Title</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="title" name="title" type="text" value="{{ old('title', $event->title) }}">
                        </div>

                        {{-- <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="description">Description</label>
                            <textarea class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="description" name="description">{{ old('description', $event->description ?? '') }}</textarea>
                        </div> --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="description">Description</label>
                            <input id="description" type="hidden" name="description"
                                value="{{ old('description', $event->description ?? '') }}">
                            <trix-editor input="description"
                                class="block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"></trix-editor>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="image_url">Image URL</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="image_url" name="image_url" type="text"
                                value="{{ old('image_url', $event->image_url) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="location">Location</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="location" name="location" type="text"
                                value="{{ old('location', $event->location) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="datetime">Date & Time</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="datetime" name="datetime" type="datetime-local"
                                value="{{ old('datetime', Carbon\Carbon::parse($event->datetime)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="price">Price (EUR)</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="price" name="price" type="text" value="{{ old('price', $event->price) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="tickets">Tickets</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="tickets" name="tickets" type="number"
                                value="{{ old('tickets', $event->tickets) }}">
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
                    <form id="delete-form" method="POST" action="{{ route('admin.events.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
