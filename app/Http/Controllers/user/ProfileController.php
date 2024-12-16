<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use URL;

class ProfileController extends Controller
{
    public function index()
    {
        $url = URL::current();
        $url = explode('/', $url);
        $user = Auth::user();

        return view('user_app.profile.profile', with([
            'route' => end($url),
            'user' => $user,
            'sidebar_data' => parent::sidebarMenu()
        ]));
    }

    public function update()
    {
        $user = Auth::user();

        return view('user_app.profile.edit', with([
            'user' => $user,
            'sidebar_data' => parent::sidebarMenu()
        ]));
    }

    public function goUpdate(Request $request)
    {
        $id = Auth::user()->id;

        $file = $request->file('ava');

        if (isset($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename = "ava_{$id}.$extension";

            $path = $file->storeAs(
                'public/avatar',
                $filename
            );

            // Return the file path or URL
            $path = Storage::url('avatar/' . $filename);
        }


        $user = User::find($request->id);
        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->jenis_kelamin = $request->gender;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->hp;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if (isset($file)) {
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()->route('profile')->with(['user' => $user]);

    }
}
