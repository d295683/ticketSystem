<x-admin-layout>
    <x-slot name="title">
        Manage Reservations
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>

    </x-slot>
    <div id="message"></div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Event
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        User
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
                                        Tickets Ordered
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase">
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
                                            <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                                class="text-indigo-400 hover:text-indigo-600">Show</a>
                                            <span class="mx-2">|</span>
                                            <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                                class="text-indigo-400 hover:text-indigo-600">Edit</a>
                                            <span class="mx-2">|</span>
                                            <form id="resetForm"
                                                action="{{ route('admin.reservations.reset', $reservation) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button id="resetButton" type="submit"
                                                    class="text-red-400 hover:text-red-600">Reset</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $reservations->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-admin-layout>
<script>
    $(document).ready(function() {
        $("#resetButton").click(function(e) {
            e.preventDefault();

            var url = $("#resetForm").attr('action');
            var formData = $("#resetForm").serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function(data) {
                    var successMessage = `
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="flex items-center p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Success</span>
                                <div>
                                    <span class="font-medium">Reset successful</span>
                                </div>
                            </div>
                        </div>
                    `;
                    $("#message").html(successMessage);
                    setTimeout(function() {
                        $("#message").empty();
                    }, 5000); // Remove after 5 seconds
                },
                error: function(data) {
                    var errorMessage = `
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="flex items-center p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Error</span>
                                <div>
                                    <span class="font-medium">Reset failed</span>
                                </div>
                            </div>
                        </div>
                    `;
                    $("#message").html(errorMessage);
                    setTimeout(function() {
                        $("#message").empty();
                    }, 5000); // Remove after 5 seconds
                }
            });
        });
    });
</script>
