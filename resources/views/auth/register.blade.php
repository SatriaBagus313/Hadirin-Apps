@extends('app')

@section('content')
    <div>
        <div class="flex justify-center bg-teal-300 items-center py-2">
            <img src="pnm.webp" alt="" class="h-16 mr-2">
            <div class="text-center font-medium text-3xl">
                HADIRIN_APPS
            </div>
        </div>
        <div class="flex justify-end space-x-4 px-8 mt-4">
            <div>
                <a {{ str_contains(URL::current(), 'register') ? '' : 'href=/register' }}
                    class="{{ str_contains(URL::current(), 'register') ? 'text-red-500' : '' }}">DAFTAR</a>
            </div>
            <div>
                <a {{ str_contains(URL::current(), 'login') ? '' : 'href=/login' }}
                    class="{{ str_contains(URL::current(), 'login') ? 'text-red-500' : '' }}">LOGIN</a>
            </div>
        </div>
        <div class="text-center text-lg font-medium">
            Registrasi Akun
        </div>
        <div class="max-w-[600px] mx-auto">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>
                            <div class="text-red-400"{{ $e }}></div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('doRegister') }}" method="post" class="space-y-4 mt-4">
                @csrf
                <div class="w-full flex items-center">
                    <span class="w-40">Nama Lengkap</span>
                    <input type="text" name="full_name" id="full_name" required class="border w-full py-1 px-2"
                        autofocus>
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">Nama Panggilan</span>
                    <input type="text" name="name" id="name" required class="border w-full py-1 px-2">
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">Email</span>
                    <input type="email" name="email" id="email" required class="border w-full py-1 px-2">
                </div>
                <div class="w-full flex">
                    <div class="w-40">Jenis Kelamin</div>
                    <div>
                        <div>
                            <input type="radio" name="gender" id="man" value="0" required
                                class="border py-1 px-2">
                            <label for="man" class="w-40">Laki-laki</label>
                        </div>
                        <div>
                            <input type="radio" name="gender" id="woman" value="1" class="border py-1 px-2">
                            <label for="woman" class="w-40">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">Alamat Lengkap</span>
                    <textarea name="address" id="address" required rows="3" class="border w-full py-1 px-2"></textarea>
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">No. HP</span>
                    <input type="text" name="phone" id="phone" required class="border w-full py-1 px-2">
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">Password</span>
                    <input type="password" name="password" id="password" required class="border w-full py-1 px-2">
                </div>
                <div class="w-full flex items-center">
                    <span class="w-40">Konfirmasi Password</span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="border w-full py-1 px-2">
                </div>
                <div class="text-end">
                    <button type="submit" class="bg-black text-white px-4 py-2 hover:bg-slate-800">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
