<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    
    public function topUp(Request $request)
    {
        $request->validate([
            'credit' => 'required|numeric|min:1000'
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'credit' => $request->credit,
            'debit' => 0,
            'status' => 'process', 
            'description' => 'Top-Up Saldo'
        ]);

        return redirect()->back()->with('status', 'Permintaan Top-Up sedang diproses');
    }

   
    public function withdraw(Request $request)
    {
        $request->validate([
            'debit' => 'required|numeric|min:1000'
        ]);

        $user = Auth::user();
        $totalSaldo = Wallet::where('user_id', $user->id)->where('status', 'done')->sum(DB::raw('credit - debit'));

        if ($totalSaldo < $request->debit) {
            return redirect()->back()->with('status', 'Saldo tidak cukup untuk withdraw!');
        }

        Wallet::create([
            'user_id' => $user->id,
            'credit' => 0,
            'debit' => $request->debit,
            'status' => 'process', 
            'description' => 'Withdraw Saldo'
        ]);

        return redirect()->back()->with('status', 'Permintaan Withdraw sedang diproses');
    }


    public function transfer(Request $request)
{
    $request->validate([
        'recipient_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:1000'
    ]);

    $user = Auth::user();
    $recipient = User::findOrFail($request->recipient_id);

    // Cek saldo pengguna
    $totalSaldo = Wallet::where('user_id', $user->id)->where('status', 'done')->sum(DB::raw('credit - debit'));

    if ($totalSaldo < $request->amount) { 
        return redirect()->back()->with('status', 'Saldo tidak cukup untuk transfer!');
    }

    DB::beginTransaction();
    try {
        // Kurangi saldo pengirim
        Wallet::create([
            'user_id' => $user->id,
            'credit' => 0,
            'debit' => $request->amount,
            'status' => 'process', 
            'description' => 'Transfer ke ' . $recipient->name
        ]);

        // Tambah saldo penerima
        Wallet::create([
            'user_id' => $recipient->id,
            'credit' => $request->amount,
            'debit' => 0,
            'status' => 'process', 
            'description' => 'Transfer dari ' . $user->name
        ]);

        DB::commit();
        return redirect()->back()->with('status', 'Transfer berhasil!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('status', 'Terjadi kesalahan, transfer gagal!');
    }
}
    public function acceptRequest(Request $request)
    {
        $wallet = Wallet::findOrFail($request->wallet_id);
        $wallet->update(['status' => 'done']);

        return redirect()->back()->with('status', 'Permintaan berhasil disetujui');
    }
}
