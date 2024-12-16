<div class="bg-slate-50 w-full h-dvh shadow-lg">
    <div class="flex justify-between bg-sky-400 shadow-lg h-32 px-2 content-center text-2xl">
        <img src="" alt="">
        <div class="mt-4 md:hidden" onclick="toggle()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    <div class="mt-4">
        SMP N 2 Telukjambe Barat
    </div>
    <div class="bg-sky-400">
        <div class="h-[1px] bg-slate-400 mx-8 rounded-lg"></div>
    </div>
    <div class="text-lg bg-sky-400 pt-2 pb-2 px-2">
        Halo, {{ Auth::user()->name }}
    </div>
    <div class="pt-2 px-4 py-2">
        <div>
            <ul class="space-y-2">
                @foreach ($sidebar_data as $s)
                    <a href="{{ $s->route }}">{{ $s->title }}</a>
                @endforeach
                {{-- <a href="/">
                    <li class="hover:bg-sky-300 rounded-md p-2 {{ $url == 'dashboard' ? 'bg-sky-200' : '' }}">
                        Dashboard</li>
                </a>
                <a href="/data-absensi">
                    <li class="hover:bg-sky-300 rounded-md p-2 {{ $url == 'data-absensi' ? 'bg-sky-200' : '' }}">
                        Data Absensi</li>
                </a>
                <a href="/data-guru">
                    <li class="hover:bg-sky-300 rounded-md p-2 {{ $url == 'data-guru' ? 'bg-sky-200' : '' }}">
                        Data Guru</li>
                </a>
                <a href="{{ route('data.lokasi') }}">
                    <li class="hover:bg-sky-300 rounded-md p-2 {{ $url == 'data-lokasi' ? 'bg-sky-200' : '' }}">
                        Data Lokasi</li>
                </a>
                <a href="{{ route('data.izin') }}">
                    <li class="hover:bg-sky-300 rounded-md p-2 {{ $url == 'data-izin' ? 'bg-sky-200' : '' }}">
                        Data Izin</li>
                </a> --}}
            </ul>
            <div class="h-[1px] bg-slate-200 my-4 mx-8 rounded-lg"></div>
            <div>
                <a href="{{ route('logout') }}">
                    <div class="bg-red-400 hover:bg-red-500 text-white px-2 py-1 rounded-md">
                        Logout
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
