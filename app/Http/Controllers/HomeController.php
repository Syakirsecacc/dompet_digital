<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {

        if(Auth::user()->role == 'admin'){
            $user = User::all()->count();
            $userAll = User::all();
            $mutasi = Wallet::where('status', 'done')->orderBy('created_at', 'DESC')->get();
            

            return view('home', compact('user', 'userAll', 'mutasi'));
        }
        if(Auth::user()->role == 'bank'){
            $wallets = Wallet::where('status', 'done')->get();

            $credit = 0;
            $debit = 0;
            foreach ($wallets as $wallet){
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;
            $nasabah = User::where('role', 'siswa')->get()->count();
            $request_payment = Wallet::where('status', 'process')->orderBy('created_at', 'DESC')->get();
            $mutasi = Wallet::where('status', 'done')->orderBy('created_at', 'DESC')->get();
            $allMutasi = Wallet::where('status', 'done')->count();
            
            

            return view('home', compact('allMutasi', 'saldo', 'nasabah', 'request_payment', 'mutasi'));
        }

        if (Auth::user()->role == 'siswa') {
            $user = Auth::user();
            $wallets = Wallet::where('user_id', Auth::user()->id)->where('status', 'done')->get();
            $credit = 0;
            $debit = 0;

            foreach ($wallets as $wallet) {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }

            $saldo = $credit - $debit;

            $mutasi = Wallet::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            $users = User::where('role', 'siswa')->where('id', '!=', $user->id)->get();
            return view('home', compact('saldo', 'mutasi','users'));
        }
    }
}
