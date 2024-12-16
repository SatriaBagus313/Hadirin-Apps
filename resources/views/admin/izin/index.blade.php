@extends('index')

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
                Data Izin
            </div>
        </div>
        <div class="mt-4">
            <table class="table-auto border border-collapse w-full">
                <thead>
                    <th class="border p-2">No.</th>
                    <th class="border p-2">Nama Siswa</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Keterangan</th>
                    <th class="border p-2">Catatan</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Bukti</th>
                    <th class="border p-2">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($izinBelum as $key => $absen)
                        <tr
                            class="
                        {{ $absen->status == 'sudah' ? 'bg-green-400' : '' }}
                         {{ $absen->status == 'tolak' ? 'bg-red-400' : '' }}
                            ">
                            <td class="border p-2">
                                {{ $key + 1 }}
                            </td>
                            <td class="border p-2">
                                {{ $absen->user->full_name }}
                            </td>
                            <td class="border p-2">
                                {{ $absen->tanggal }}
                            </td>
                            <td class="border p-2">
                                {{ $absen->keterangan }}
                            </td>
                            <td class="border p-2">
                                {{ $absen->catatan }}
                            </td>
                            <td class="border p-2">
                                {{ $absen->status }}
                            </td>
                            <td class="border p-2">
                                <img src="{{ Storage::url($absen->photo_path) }}" alt="" class="w-32 h-32">
                            </td>
                            <td class="border p-2">
                                @if ($absen->status == 'belum')
                                    <div class="flex space-x-2">
                                        <form action="{{ route('izin.ubah') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $absen->id }}">
                                            <input type="hidden" name="status" id="status" value="sudah">
                                            <button
                                                class="bg-sky-400 px-2 py-1 text-white hover:bg-sky-700 rounded-md w-min"
                                                type="submit">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('izin.ubah') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $absen->id }}">
                                            <input type="hidden" name="status" id="status" value="tolak">
                                            <button class="bg-red-400 px-2 py-1 text-white hover:bg-red-700 rounded-md"
                                                id="delete{{ $absen->id }}" data-user="{{ $absen->name }}"
                                                data-id="{{ $absen->id }}" type="submit">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="flex space-x-2">
                                        <form action="{{ route('izin.ubah') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $absen->id }}">
                                            <input type="hidden" name="status" id="status" value="belum">
                                            <button
                                                class="bg-sky-400 px-2 py-1 text-white hover:bg-sky-700 rounded-md w-min"
                                                type="submit">
                                                Batalkan
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
