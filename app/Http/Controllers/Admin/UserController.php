<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount('bookings')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create(Request $request): View
    {
        return view('admin.users.create', ['presetRole' => $request->query('role')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:user,supervisor,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function show(User $user): View
    {
        $user->loadCount('bookings');
        $bookings = $user->bookings()->with('concert')->latest()->take(10)->get();

        return view('admin.users.show', compact('user', 'bookings'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:user,supervisor,admin',
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tidak bisa menghapus akun sendiri!']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }

    public function topUp(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $amount = $request->amount;

        $user->increment('balance', $amount);

        $timestamp = now()->format('ymdHis');
        Invoice::create([
            'invoice_number' => 'INV-IN-'.$timestamp,
            'type' => 'incoming',
            'amount' => $amount,
            'description' => 'Top up balance - '.$user->name,
            'invoice_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Saldo berhasil ditambahkan Rp '.number_format($amount, 0, ',', '.').' ke '.$user->name.'. Invoice created.');
    }
}
