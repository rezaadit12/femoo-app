<?php

namespace App\Http\Controllers;

use App\Models\M_history;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class mainController extends Controller
{
    public function index()
    {

        $thisUser = Auth::user();
        $rankUser = User::orderBy('updated_at', 'asc')->take(10)->get();

        return view('module.main.index', compact('thisUser', 'rankUser'));
        // dd($thisUser);
    }

    public function rank()
    {
        $thisUser = Auth::user();
        $rankUser = User::orderBy('updated_at', 'asc')->get(); // limit 10

        return view('module.main.rank', compact('thisUser', 'rankUser'));

    }

    public function history()
    {
        $thisUser = Auth::user()->id;
        // $rankUser = User::all(); // limit 10

        $history = M_history::where('users_id', $thisUser)->orderBy('id', 'DESC')->get();
        return view('module.main.history', compact('history'));

    }

    public function relapsed(Request $request)
    {
        $idUser = Auth::user()->id;
        $reason = $request->reason ?: '-'; // Jika 'reason' kosong, set menjadi '-'

        // Menyimpan data ke dalam tabel M_history
        M_history::create([
            'users_id' => $idUser, // Menggunakan ID user yang sedang login
            'relapseDays' => now(), // Menyimpan tanggal dan waktu saat ini
            'reasons' => $reason, // Menyimpan alasan dari inputan user, jika kosong akan diset '-'
        ]);

        User::where('id', $idUser)
        ->update([
            'lastRelapsed' => Date::now(),
        ]);

        return back();
    }

    public function editUser(Request $request){
        $idUser = Auth::user()->id;
        User::where('id', $idUser)
        ->update([
            'name' => $request->name,
        ]);
        return back();
    }
}
