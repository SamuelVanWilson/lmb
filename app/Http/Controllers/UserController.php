<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Ambil riwayat transaksi milik user tersebut, beserta data destinasinya
        $transactions = Transaction::where('user_id', $user->id)
                                    ->with('destination') // Eager loading untuk efisiensi
                                    ->latest()
                                    ->get();

        return view('client/profile', [
            'user' => $user,
            'transactions' => $transactions
        ]);
    }
}
