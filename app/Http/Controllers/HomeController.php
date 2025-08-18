<?php

namespace App\Http\Controllers;
use App\Models\Destination;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $destinations = Destination::latest()->take(6)->get();

        // Kirim data tersebut ke view 'home'
        return view('home', [
            'destinations' => $destinations
        ]);
    }

    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }

    /**
     * Memproses pemesanan tiket.
     */
    public function store(Request $request, Destination $destination)
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

    public function destination()
    {
        $destinations = Destination::latest()->get();
        return view('destinations.index', compact('destinations'));
    }
}
