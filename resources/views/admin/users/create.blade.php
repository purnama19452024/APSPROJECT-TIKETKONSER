@extends('admin.layouts.app')
@section('title', 'Add User')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700">&larr; Back to Users</a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Add User / Supervisor</h1>
</div>

<div class="max-w-lg">
    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input type="password" name="password" required
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
            <div class="grid grid-cols-3 gap-3">
                <label class="relative">
                    <input type="radio" name="role" value="user" class="sr-only peer" {{ old('role', $presetRole ?? 'user') == 'user' ? 'checked' : '' }}>
                    <div class="text-center p-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-blue-600 cursor-pointer transition text-sm font-medium">
                        User
                    </div>
                </label>
                <label class="relative">
                    <input type="radio" name="role" value="supervisor" class="sr-only peer" {{ old('role', $presetRole ?? '') == 'supervisor' ? 'checked' : '' }}>
                    <div class="text-center p-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 peer-checked:text-purple-600 cursor-pointer transition text-sm font-medium">
                        Supervisor
                    </div>
                </label>
                <label class="relative">
                    <input type="radio" name="role" value="admin" class="sr-only peer" {{ old('role', $presetRole ?? '') == 'admin' ? 'checked' : '' }}>
                    <div class="text-center p-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 peer-checked:text-red-600 cursor-pointer transition text-sm font-medium">
                        Admin
                    </div>
                </label>
            </div>
            @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                Add User
            </button>
        </div>
    </form>
</div>
@endsection
