<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class IzinController extends Controller
{
    public function __construct()
    {

        // Set locale to Indonesian
        Carbon::setLocale('id');
    }

    public function index()
    {
        $user = Auth::user()->id;
        $izins = Izin::where('user_id', '=', $user)
            ->orderByDesc('created_at')
            ->get();
        $izins = array_map(function ($izin) {
            // Return the file path or URL
            $filePath = Storage::url($izin['photo_path']);
            $izin['photo_path'] = $filePath;
            return (object) $izin;
        }, $izins->toArray());

        return view('user_app.izin.index')->with([
            'izins' => (object) $izins,
            'sidebar_data' => parent::sidebarMenu()
        ]);
    }
    public function store(Request $request)
    {
        try {
            $user = Auth::user()->id;
            $tanggal = $request->tanggal;
            $keterangan = $request->keterangan;
            $catatan = $request->catatan;
            $file = $request->file('suket');
            $unique = uniqid('q');

            $extension = $file->getClientOriginalExtension();
            $filename = "izin_{$user}_{$unique}.$extension";

            $path = $file->storeAs(
                'public/izin',
                $filename
            );

            $izin = new Izin;
            $izin->user_id = Auth::user()->id;
            $izin->tanggal = $tanggal;
            $izin->keterangan = $keterangan;
            $izin->photo_path = $path;
            $izin->catatan = $catatan;
            $izin->save();

            return redirect()->route('izin.index', ['success' => "Pengajuan {$keterangan} sukses"]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengajukan izin. Code: ' . $th->getCode()]);
        }
    }

    public function successIndex(Request $request)
    {
        $izindata = Izin::find(25);

        // Format tanggal
        $carbon = Carbon::parse($izindata->tanggal);
        $formattedDate = $carbon->translatedFormat('d F Y');

        $izindata->tanggal = $formattedDate;
        $user = $izindata->user;

        $data = [
            'user' => $user,
            'izin' => $izindata
        ];

        return view('user_app/izin/sukses', with($data));
    }

    public function adminIndex()
    {
        $url = URL::current();
        $url = explode('/', $url);
        $izin = Izin::orderBy('created_at', 'desc')
            ->orderBy('status')
            ->get();
        $izinSudah = Izin::where('status', '=', 'sudah')->orWhere('status', '=', 'tolak')->get();

        return view('admin.izin.index')->with([
            'url' => end($url),
            'izinBelum' => $izin,
            'izinSudah' => $izinSudah,
            'sidebar_data' => parent::sidebarMenu()
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->status;

        $izin = Izin::find($id);
        $izin->status = $data;

        $result = $izin->save();

        if ($result) {
            return redirect()->route('data.izin');
        }
    }
}
