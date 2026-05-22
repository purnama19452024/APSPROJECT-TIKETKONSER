<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConcertController extends Controller
{
    public function index(): View
    {
        $concerts = Concert::latest()->paginate(10);

        return view('admin.concerts.index', compact('concerts'));
    }

    public function create(): View
    {
        return view('admin.concerts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('concerts', 'public');
        }

        Concert::create($validated);

        return redirect()->route('admin.concerts.index')
            ->with('success', 'Konser berhasil ditambahkan!');
    }

    public function edit(Concert $concert): View
    {
        return view('admin.concerts.edit', compact('concert'));
    }

    public function update(Request $request, Concert $concert): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            if ($concert->image) {
                Storage::disk('public')->delete($concert->image);
            }
            $validated['image'] = $request->file('image')->store('concerts', 'public');
        }

        $concert->update($validated);

        return redirect()->route('admin.concerts.index')
            ->with('success', 'Konser berhasil diperbarui!');
    }

    public function destroy(Concert $concert): RedirectResponse
    {
        $concert->delete();

        return redirect()->route('admin.concerts.index')
            ->with('success', 'Konser berhasil dihapus!');
    }
}
