@extends('app')

@section('content')
    <div class="justify-center px-4 text-slate-800">
        <div class="flex justify-center bg-teal-300 items-center py-2">
            <img src="pnm.webp" alt="" class="h-16 mr-2">
            <div class="text-center font-medium text-3xl">
               HADIRIN KELOMPOK 7
            </div>
        </div>
        <div class="flex justify-end space-x-4">
            {{-- <div>
                <a {{ str_contains(URL::current(), 'register') ? '' : 'href=/register' }}
                    class="{{ str_contains(URL::current(), 'register') ? 'text-red-500' : '' }}">DAFTAR</a>
            </div> --}}
            <div>
                <a {{ str_contains(URL::current(), 'login') ? '' : 'href=/login' }}
                    class="{{ str_contains(URL::current(), 'login') ? 'text-red-500' : '' }}">LOGIN</a>
            </div>
        </div>
        <div class="justify-center flex">
            @if (Session::get('success'))
                <div class="text-gray-400">{{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="text-red-400">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="min-w-[500px] max-w-[600px] p-4 space-y-4">
                @csrf
                <div class="text-center text-3xl my-8">
                    Absensi Siswa
                </div>
                @if (Session::has('error'))
                    <div class="text-red-400">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div>
                    <div>
                        <label for="email">{{ __('Email') }} <span class="text-rose-500">*</span></label>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="email"
                        class="border-2 p-2 mt-2 border-slate-200 rounded-md w-full focus:border-2 focus:outline-none focus:border-sky-400 " />
                </div>
                <div>
                    <div>
                        <label for="password">{{ __('Password') }} <span class="text-rose-500">*</span></label>
                    </div>
                    <input id="password" type="password" name="password" :value="old('password')" required
                        autocomplete="password"
                        class="border-2 p-2 mt-2 border-slate-200 rounded-md w-full focus:border-2 focus:outline-none focus:border-sky-400 " />
                </div>
                <div>
                    <a href="{{ route('password.reset') }}" class="hover:text-blue-700 hover:underline">Lupa Kata
                        Sandi?</a>
                </div>
                <div class="justify-end flex">
                    <button type="submit"
                        class="bg-black py-1 px-4 rounded-sm text-white cursor-pointer hover:bg-slate-800">login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
