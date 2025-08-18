<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $transactionCount = Transaction::count();

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'transactionCount' => $transactionCount,
        ]);
    }

    public function transactions()
    {
        $transactions = Transaction::with(['user', 'destination'])->get();
        return view('admin.transactions', compact('transactions'));
    }
}
