@extends('index')

@section('admin-content')
    <div class="m-4 mt-8">
        <div class="flex">
            <div class="md:hidden" id="hamburger" onclick="toggle()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="text-center text-xl md:text-3xl">
                Selamat Datang Di HADIRIN_APPS Kelompok 7
            </div>
        </div>
        <div class="flex items-center space-x-1">
            <div class="bg-slate-400 my-8 h-[1px] w-full"></div>
            <div class="w-1 h-1 bg-slate-400 rounded-full"></div>
            <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
            <div class="w-1 h-1 bg-slate-400 rounded-full"></div>
            <div class="bg-slate-400 my-8 h-[1px] w-full"></div>
        </div>

        {{-- Content --}}
        <div class="mt-4 space-y-4 md:space-y-0 md:grid grid-cols-3 gap-4">
            <div class="p-2 rounded-md h-24 relative w-full bg-gradient-to-br from-green-400 to-green-300">
                <div class="text-slate-500">Jumlah Siswa</div>
                <div class="text-center mb-8">
                    <div class="text-3xl">{{ $count }}</div>
                </div>
            </div>
            <div class="p-2 rounded-md h-24 relative w-full bg-gradient-to-br from-orange-400 to-orange-300">
                <div class="text-slate-500">Sudah Absen Hari Ini</div>
                <div class="text-center mb-8">
                    <div class="text-3xl">{{ $absenCount }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
