<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Withdrawal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WithdrawalController extends Controller
{
    public function index(): View
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(10);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function show(Withdrawal $withdrawal): View
    {
        $withdrawal->load('user', 'invoice');

        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    public function approve(Withdrawal $withdrawal): RedirectResponse
    {
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors(['error' => 'Withdrawal already processed.']);
        }

        $user = $withdrawal->user;

        if ($user->balance < $withdrawal->amount) {
            return back()->withErrors(['error' => 'Insufficient balance. User only has Rp '.number_format($user->balance, 0, ',', '.').'.']);
        }

        $user->decrement('balance', $withdrawal->amount);

        $withdrawal->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        $timestamp = now()->format('ymdHis');
        Invoice::create([
            'invoice_number' => 'INV-OUT-'.$timestamp,
            'type' => 'outgoing',
            'amount' => $withdrawal->amount,
            'description' => 'Withdrawal by '.$withdrawal->user->name.' ('.$withdrawal->account_holder.' - '.$withdrawal->bank_name.')',
            'invoice_date' => now()->toDateString(),
            'reference_type' => Withdrawal::class,
            'reference_id' => $withdrawal->id,
        ]);

        return back()->with('success', 'Withdrawal approved successfully. Invoice created.');
    }

    public function reject(Request $request, Withdrawal $withdrawal): RedirectResponse
    {
        if ($withdrawal->status !== 'pending') {
            return back()->withErrors(['error' => 'Withdrawal already processed.']);
        }

        $data = ['status' => 'rejected', 'rejected_at' => now()];

        if ($request->filled('notes')) {
            $data['notes'] = $request->notes;
        }

        $withdrawal->update($data);

        return back()->with('success', 'Withdrawal rejected.');
    }
}
