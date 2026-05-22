<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WithdrawalController extends Controller
{
    public function index(): View
    {
        $withdrawals = Auth::user()->withdrawals()->latest()->paginate(10);

        return view('user.withdrawals.index', compact('withdrawals'));
    }

    public function create(): View
    {
        $balance = Auth::user()->balance;

        return view('user.withdrawals.create', compact('balance'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:10000',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->balance < $data['amount']) {
            return back()->withErrors(['amount' => 'Saldo tidak mencukupi. Saldo Anda: Rp '.number_format($user->balance, 0, ',', '.')])->withInput();
        }

        $user->withdrawals()->create($data);

        return redirect()->route('user.withdrawals.index')->with('success', 'Withdrawal request submitted. Waiting for admin approval.');
    }
}
