@extends('admin.layouts.app')
@section('title', 'Manage Users')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Users</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Manage all users, supervisors, and admins.</p>
    </div>
    @if (Auth::user()->isAdmin())
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add User
    </a>
    @endif
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    @if ($users->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Photo</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Name</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Email</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Role</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Bookings</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Balance</th>
                        <th class="text-left px-4 py-3 font-medium text-gray-500">Joined</th>
                        <th class="text-right px-4 py-3 font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-4 py-3">
                                @if ($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="" class="w-9 h-9 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">{{ substr($user->name, 0, 1) }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium
                                    @if($user->role === 'admin') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                    @elseif($user->role === 'supervisor') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                    @else bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $user->bookings_count }}</td>
                            <td class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Rp {{ number_format($user->balance, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium mr-2">Detail</a>
                                @if (Auth::user()->isAdmin())
                                <button onclick="openTopUp({{ $user->id }}, '{{ $user->name }}')" class="text-green-600 hover:text-green-700 text-sm font-medium mr-2">Top Up</button>
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium mr-2">Edit</a>
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium">Delete</button>
                                    </form>
                                @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">
            {{ $users->links() }}
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <p>No users yet.</p>
        </div>
    @endif
</div>
<div id="topUpModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-800 w-full max-w-md p-6 relative">
        <button onclick="closeTopUp()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Top Up Balance</h3>
        <p class="text-sm text-gray-500 mb-5">Add balance to <span id="topUpUserName" class="font-medium text-gray-700 dark:text-gray-300"></span></p>
        <form id="topUpForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount (Rp)</label>
                <input type="number" name="amount" min="1000" step="500" placeholder="Min 1.000" required class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2.5 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition">Top Up</button>
        </form>
    </div>
</div>

<script>
function openTopUp(id, name) {
    document.getElementById('topUpUserName').textContent = name;
    document.getElementById('topUpForm').action = '/admin/users/' + id + '/top-up';
    document.getElementById('topUpModal').classList.remove('hidden');
}
function closeTopUp() {
    document.getElementById('topUpModal').classList.add('hidden');
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeTopUp();
});
</script>
@endsection
