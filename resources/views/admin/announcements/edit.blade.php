@extends('admin.layouts.app')
@section('title', 'Edit Announcement')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.announcements.index') }}" class="text-sm text-blue-600 hover:text-blue-700">&larr; Back</a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Edit Announcement</h1>
</div>
<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
            <div id="editor" class="min-h-[300px] border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-white"></div>
            <textarea name="content" id="contentInput" required class="hidden">{{ old('content', $announcement->content) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center gap-2">
                    <input type="radio" name="status" value="active" {{ old('status', $announcement->status) === 'active' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
                </label>
                <label class="inline-flex items-center gap-2">
                    <input type="radio" name="status" value="inactive" {{ old('status', $announcement->status) === 'inactive' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Inactive</span>
                </label>
            </div>
        </div>
        <div class="pt-2">
            <button type="submit" onclick="document.getElementById('contentInput').value = document.querySelector('#editor .ql-editor').innerHTML" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">Update</button>
        </div>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write announcement content...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: [] }],
                ['link', 'blockquote', 'code-block'],
                [{ color: [] }, { background: [] }],
                ['clean']
            ]
        }
    });
    quill.root.innerHTML = document.getElementById('contentInput').value;
</script>
@endsection
