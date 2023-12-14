@forelse ($users as $user)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
        <td class="px-6 py-4">
            @foreach ($user->roles as $role)
                <span
                    class="bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-200 mr-2 mb-2">
                    {{ $role->name }}
                </span>
            @endforeach
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-400 hover:text-indigo-600">Edit</a>
        </td>
    </tr>
@endforelse
