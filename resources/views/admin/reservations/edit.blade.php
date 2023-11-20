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

                    <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}">
                        @csrf
                        @method('PATCH')

                        {{-- <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-200" for="name">Name</label>
                            <input
                                class="mt-1 block w-full py-2 px-3 border border-gray-600 rounded-md bg-gray-700 text-gray-200"
                                id="name" name="name" type="text" value="{{ old('name', $reservation->name) }}">
                        </div> --}}

                        <div class="mb-4">
                            <div class="flex justify-between">
                                <span class="mb-2 block text-xl font-medium text-gray-200">Tickets</span>

                            </div>
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                            Id</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                            Code</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                            Used
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-600">
                                    @foreach ($reservation->tickets as $ticket)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="hidden" name="tickets[{{ $ticket->id }}][used]"
                                                        value="0">
                                                    <input type="checkbox" name="tickets[{{ $ticket->id }}][used]"
                                                        value="1" class="sr-only peer"
                                                        {{ $ticket->used ? 'checked' : '' }}>
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>

                            <div>
                                <button type="submit" form="reset-form"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Reset All
                                </button>

                                <button type="submit" form="delete-form"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>

                    <form id="reset-form" method="POST" action="{{ route('admin.reservations.reset', $reservation) }}">
                        @csrf
                        @method('PATCH')
                    </form>

                    <form id="delete-form" method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
