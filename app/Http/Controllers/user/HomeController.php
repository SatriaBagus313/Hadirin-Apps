<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use URL;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'ADMIN') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }

    }

    public function userHome()
    {
        $user = Auth::user();

        $masuk = "SELECT a.created_at FROM absensis a
                WHERE created_at >= CURDATE() 
                AND created_at < CURDATE() + INTERVAL 1 DAY 
                AND a.jenis = 'MASUK'
                AND a.user_id = {$user->id};";

        $pulang = "SELECT a.created_at FROM absensis a
                WHERE created_at >= CURDATE() 
                AND created_at < CURDATE() + INTERVAL 1 DAY 
                AND a.jenis = 'PULANG'
                AND a.user_id = {$user->id};";

        $dbMasuk = DB::select($masuk);
        if ($dbMasuk) {
            $jamMasuk = $dbMasuk[0]->created_at;
            $cMasuk = Carbon::parse($jamMasuk);
            $timeMasuk = $cMasuk->translatedFormat('H:i');
        }
        $dbPulang = DB::select($pulang);
        if ($dbPulang) {
            $jamPulang = $dbPulang[0]->created_at;
            $cPulang = Carbon::parse($jamPulang);
            $timePulang = $cPulang->translatedFormat('H:i');
        }

        return view('user_app.home', with([
            'route' => '/',
            'user' => $user,
            'masuk' => $timeMasuk ?? '-',
            'pulang' => $timePulang ?? '-',
            'sidebar_data' => parent::sidebarMenu()
        ]));
    }
}
