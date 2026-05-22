@extends('user.layouts.app')
@section('title', 'Chat Admin')
@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">Chat Admin</h1>
    <p class="text-gray-400 mt-1">Hubungi admin untuk bantuan.</p>
</div>

<div class="max-w-3xl">
    <div class="glass-card rounded-2xl overflow-hidden">
        <div class="h-96 overflow-y-auto p-6 space-y-4" id="chatMessages">
            @forelse ($messages as $msg)
                <div class="flex {{ $msg->sender === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-sm {{ $msg->sender === 'user' ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : 'bg-white/10 text-gray-200' }} rounded-2xl px-4 py-3 text-sm">
                        @if ($msg->image)
                            <div class="relative group inline-block">
                                <img src="{{ Storage::url($msg->image) }}" class="max-w-full rounded-lg mb-2 cursor-pointer hover:opacity-80 transition" onclick="window.open(this.src,'_blank')">
                                @if ($msg->sender === 'user')
                                    <form method="POST" action="{{ route('chats.image.delete', $msg) }}" class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-6 h-6 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-red-500/80 transition" onclick="return confirm('Hapus gambar ini?')">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                        @if ($msg->message)
                            <p>{{ $msg->message }}</p>
                        @endif
                        <p class="text-xs mt-1 opacity-60">{{ $msg->created_at->format('H:i, d M') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-8">No messages yet. Start a conversation!</p>
            @endforelse
        </div>
        <div class="border-t border-white/5 p-4">
            <form method="POST" action="{{ route('user.chat.store') }}" enctype="multipart/form-data" class="flex flex-col gap-3">
                @csrf
                <div class="flex gap-3">
                    <input type="text" name="message" placeholder="Type your message..." 
                        class="flex-1 px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <label class="flex items-center justify-center px-3 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:bg-white/10 cursor-pointer transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" onchange="this.closest('form').querySelector('input[name=message]').placeholder=this.files[0]?.name||'Type your message...'">
                    </label>
                    <button type="submit" class="px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var chat = document.getElementById('chatMessages');
    if (chat) chat.scrollTop = chat.scrollHeight;
</script>
@endsection
