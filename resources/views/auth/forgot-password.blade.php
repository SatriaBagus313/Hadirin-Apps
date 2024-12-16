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
        <div class="w-1/2 mx-auto border rounded">
            <div class="text-center text-lg">Reset Kata Sandi</div>
            @if (Session::get('status'))
                <div class="text-green-400">
                    {{ Session::get('status') }}
                </div>
            @endif
            @if ($errors->has('email'))
                <ul>
                    @foreach ($errors->all() as $e)
                        <li class="text-red-400">{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('pass-reset') }}" method="post" class="flex flex-col">
                @csrf
                <label for="email">Masukkan email Anda</label>
                <input type="email" name="email" id="email" placeholder="Masukkan alamat email..." required>
                <button type="submit" class="bg-teal-400 px-3 py-1 mt-4 hover:bg-teal-300">Reset Kata Sandi</button>
            </form>
        </div>
    </div>
@endsection
