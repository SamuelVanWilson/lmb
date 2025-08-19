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
        $transactions = $user->transactions()->with('destination')->latest()->get();

        return view('client/profile', [
            'user' => $user,
            'transactions' => $transactions
        ]);
    }

    public function comment(Request $request, Destination $destination)
    {
        // 1. Cek dulu apakah user sudah login.
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login untuk menambahkan komentar.');
        }

        // 2. Validasi input komentar.
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        // 3. Buat dan simpan komentar baru.
        Comment::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'destination_id' => $destination->id,
            'content' => $request->content,
        ]);

        // 4. Kembali ke halaman detail sebelumnya dengan pesan sukses.
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Memproses pemesanan tiket.
     */
    public function transaction(Request $request, Destination $destination)
    {
        // LANGKAH 1: Cek apakah user sudah login atau belum.
        if (!Auth::check()) {
            // Jika belum, redirect ke halaman login dengan pesan error.
            return redirect()->route('login')
                ->with('error', 'Untuk melakukan pemesanan, Anda harus login terlebih dahulu.');
        }

        // Jika sudah login, lanjutkan proses seperti biasa.
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:saldo,cash',
        ]);

        $user = Auth::user();
        $quantity = $request->quantity;
        $totalPrice = $destination->ticket_price * $quantity;

        try {
            DB::transaction(function () use ($user, $destination, $quantity, $totalPrice, $request) {
                if ($destination->stock < $quantity) {
                    throw new \Exception('Stok tiket tidak mencukupi.');
                }

                $status = 'menunggu pembayaran'; // Default status
                $message = 'Pemesanan Anda sedang diproses, silakan lakukan pembayaran.';

                if ($request->payment_method === 'saldo') {
                    if ($user->balance < $totalPrice) {
                        throw new \Exception('Saldo Anda tidak mencukupi.');
                    }
                    $user->balance -= $totalPrice;
                    $user->save();
                    $status = 'berhasil'; // Status langsung berhasil jika pakai saldo
                    $message = 'Pemesanan tiket berhasil!';
                }

                $destination->stock -= $quantity;
                $destination->save();


                $order = Transaction::create([
                    'user_id' => $user->id,
                    'destination_id' => $destination->id,
                    'quantity' => $quantity,
                    'amount' => $totalPrice,
                    'payment_method' => $request->payment_method,
                    'status' => $status, // Gunakan status dinamis
                ]);

                // Simpan pesan sukses di session untuk ditampilkan nanti
                session()->flash('success', $message);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('profile');
    }
}
