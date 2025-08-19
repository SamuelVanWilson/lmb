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
        $destination->load('comments.user');
        return view('destinations.show', compact('destination'));
    }


    public function destination()
    {
        $destinations = Destination::latest()->get();
        return view('destinations.index', compact('destinations'));
    }
}
