@extends('app')

@section('map_header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection

@section('content')
    <div class="mt-0 mb-4">
        <div class="w-full absolute h-[272px] -z-10 -top-4 bg-blue-500 rounded-b-full"></div>
        <div class="mt-4 mx-4">
            <div>
                {{-- Todo nanti diganti dengan gambar selfie --}}
                <img src="{{ $data->photo_path }}" alt="" class="w-64 h-64 mx-auto rounded-lg">
            </div>
            <div class="mt-4 text-xl text-center">
                Selamat, <span class="font-medium"> {{ Auth::user()->full_name }} </span>
            </div>
            <div class="mt-4">
                Anda berhasil absen <span class="font-bold uppercase">masuk</span>. Semangat!!
            </div>
            <div class="mt-4">
                Berikut detail absen Anda:
            </div>
            <div class="md:flex mt-2">
                <div class="w-full md:w-1/3 h-40 md:h-60">
                    <div id="map" class="bg-red-400 w-full h-full rounded-md"></div>
                </div>
                <div class="grow space-y-2 mt-2 md:mt-0 md:ml-8">
                    <div class="flex">
                        <div class="w-1/2">Jenis</div>
                        <div>: Absen {{ $data->jenis }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2">Jam</div>
                        <div>: {{ $data->jam }} </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2">Latitude</div>
                        <div>: {{ $data->lat }} </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2">Longitude</div>
                        <div>: {{ $data->lng }} </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                <a href="/" class="bg-sky-400 mx-auto mt-4 p-2 text-white shadow-md rounded-xl">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        var latitude = '{{ $data->lat }}';
        var longitude = '{{ $data->lng }}';
        var map = L.map('map').setView([latitude, longitude], 17);
        var marker = new L.marker([latitude, longitude]).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    </script>
@endsection
