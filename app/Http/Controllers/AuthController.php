<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $credential = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credential)) {
            return redirect()->route('home');
        } else {
            // Todo nanti tambah flash session

            return redirect()->route('login')
                ->with(['error' => 'Email atau Kata sandi salah']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function register(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'full_name' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'gender' => 'required|integer|in:0,1',
                'address' => 'required',
                'phone' => 'required'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->jenis_kelamin = $request->gender;
            $user->alamat = $request->address;
            $user->no_hp = $request->phone;
            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->route('login')->with(['success' => 'Pendaftaran akun sukses. Silahkan login.']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->withErrors(['error' => 'Gagal membuat akun, coba lagi. Kode : ' . $th->getCode()]);
        }
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
