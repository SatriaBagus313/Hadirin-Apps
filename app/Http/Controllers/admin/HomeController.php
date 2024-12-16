<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;

class HomeController extends Controller
{
    public function index()
    {
        $url = URL::current();
        $url = explode('/', $url);

        $now = Carbon::now();
        $date = $now->day;
        $month = $now->month;
        $year = $now->year;

        $count = User::where('role', 'user')->count();
        $absenCount = Absensi::whereDate('created_at', '=', $date)
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->where('jenis', '=', 'masuk')
            ->count();

        return view('admin.dashboard', with([
            'url' => end($url),
            'count' => $count,
            'absenCount' => $absenCount,
            'sidebar_data'=> parent::sidebarMenu()
        ]));
    }
}
