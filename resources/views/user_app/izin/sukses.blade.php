@extends('app')

@section('content')
    <div class="mt-4 px-4">
        <div class="text-center text-lg">
            Pengajuan <span class="capitalize"> {{ $izin->keterangan }} </span>
            Sukses</div>
        <div class="mt-8">Berikut detail pengajuan izin Anda:</div>
        <div class="mt-2 mx-2 p-2 border-2 rounded-lg shadow-sm space-y-2">
            <div class="flex">
                <div class="w-1/3">Nama</div>
                <div class="px-2">:</div>
                <div class="w-2/3">{{ $user->full_name }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3">Tanggal</div>
                <div class="px-2">:</div>
                <div class="w-2/3">{{ $izin->tanggal }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3">Keterangan</div>
                <div class="px-2">:</div>
                <div class="w-2/3">{{ $izin->keterangan }}</div>
            </div>
            <div class="flex">
                <div class="w-1/3">Catatan</div>
                <div class="px-2">:</div>
                <div class="w-2/3">{{ $izin->catatan }}</div>
            </div>
            <div class="">
                <div class="flex">
                    <div class="w-1/3">Surat Keterangan</div>
                    <div class="px-2">:</div>
                    <div class="w-2/3"></div>
                </div>
                <div class="rounded-md overflow-hidden mt-2">
                    <img src="/storage/{{ $izin->photo_path }}" alt="">
                </div>
            </div>
        </div>
        <a href="/home" class="flex mt-4">
            <div class="mx-auto bg-sky-200 p-2 rounded-lg hover:bg-sky-400 hover:text-white shadow-lg">
                Kembali ke beranda
            </div>
        </a>
    </div>
@endsection
