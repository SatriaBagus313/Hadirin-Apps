@extends('index')

@section('map_header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection

@section('admin-content')
    <div class="mx-4">
        <div class="flex mt-8">
            <div class="md:hidden" id="hamburger" onclick="toggle()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="mx-4 text-3xl">
                Data Absensi {{ $day }}
            </div>
        </div>
        <div class="mt-4 flex justify-between">
            <div class="flex items-center">
                <div>
                    Filter
                </div>
                <div class="pl-8">
                    <label for="date" class="pr-4">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ $date }}" class="border p-2">
                </div>
                <div class="pl-4">
                    <label for="jenis" class="pr-4">Jenis</label>
                    <select name="jenis" id="jenis" class="p-2 px-4 border cursor-pointer">
                        <option value="semua" class="px-2">Semua</option>
                        <option value="masuk" class="px-2">Masuk
                        </option>
                        <option value="pulang" class="px-2">Pulang</option>
                    </select>
                </div>
            </div>
            <div class="flex space-x-4 items-center">
                <form action="{{ route('export.excel') }}" method="post" class="flex">
                    @csrf
                    <button class="underline text-sky-500">Ekspor Excel Untuk Bulan</button>
                    <input type="month" name="month" id="month" class="ml-4 rounded-md p-2 border">
                </form>
                <div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <table class="table-auto border border-collapse w-full">
                <thead>
                    <th class="border p-2">No.</th>
                    <th class="border p-2">Nama Siswa</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Waktu</th>
                    <th class="border p-2">Jenis</th>
                    <th class="border p-2">Selfie</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Koordinat</th>
                </thead>
                <tbody>
                    @foreach ($absensis as $key => $absen)
                        <form action="edit-guru" method="post">
                            <tr>
                                <td class="border p-2">
                                    {{ $key + 1 }}
                                </td>
                                <td class="border p-2">
                                    <input type="text" name="name" id="name" value="{{ $absen->full_name }}"
                                        disabled>
                                </td>
                                <td class="border p-2">
                                    {{ $absen->date }}
                                </td>
                                <td class="border p-2">
                                    {{ $absen->time }}
                                </td>
                                <td class="border p-2">
                                    {{ $absen->jenis }}
                                </td>
                                <td class="border p-2">
                                    <div class="w-44 md:w-auto">
                                        <img src="{{ $absen->selfie }}" alt="" class="w-40 h-40 mx-auto rounded-md">
                                    </div>
                                </td>
                                <td class="border p-2">
                                    <script>
                                        $(document).ready(function() {
                                            var latitude = "{{ $absen->lokasi['lat'] }}";
                                            var longitude = "{{ $absen->lokasi['lng'] }}";
                                            var map = L.map('map{{ $absen->id }}').setView([latitude, longitude], 14);
                                            var marker = new L.marker([latitude, longitude]).addTo(map);

                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '© OpenStreetMap contributors'
                                            }).addTo(map);
                                        });
                                    </script>
                                    <div class="bg-red-400 w-40 h-40 mx-auto" id="map{{ $absen->id }}">
                                    </div>
                                </td>
                                <td class="border p-2">
                                    <div>
                                        {{ $absen->lokasi['lat'] }}
                                    </div>
                                    <div>
                                        {{ $absen->lokasi['lng'] }}
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            document.getElementById('month').defaultValue = "{{ $month }}"

            const jenis = document.getElementById('jenis');
            const date = document.getElementById('date');

            // Tentukan nilai untuk filter jenis
            for (let i = 0; i < jenis.options.length; i++) {
                if (jenis.options[i].value == '{{ $jenis }}') {
                    jenis.selectedIndex = i;
                    break;
                }
            }

            jenis.addEventListener('change', function() {
                document.location.href = `/data-absensi?jenis=${jenis.value}&date=${date.value}`
            });

            date.addEventListener('change', function() {
                document.location.href = `/data-absensi?jenis=${jenis.value}&date=${date.value}`
            })
        })
    </script>
@endsection
