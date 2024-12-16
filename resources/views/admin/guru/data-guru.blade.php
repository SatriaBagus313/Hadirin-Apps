@extends('index')

@section('admin-content')
    <script>
        const deleteForm = document.getElementById('form-delete');
    </script>
    <div class="mx-4">
        <div class="mx-4 mt-8">
            <div class="flex mt-8 items-center">
                <div class="md:hidden" id="hamburger" onclick="toggle()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mx-4 text-3xl">
                    Data Siswa
                </div>
            </div>
            <div class="flex justify-end">
                <a href="/tambah-guru">
                    <div class="w-min bg-green-400 px-4 py-1 hover:bg-green-500">
                        Tambah
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <table class="table-auto border border-collapse w-full">
                <thead>
                    <th class="border p-2">No.</th>
                    <th class="border p-2">Nama Lengkap</th>
                    <th class="border p-2">Nama Panggilan</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Jenis Kelamin</th>
                    <th class="border p-2">Alamat</th>
                    <th class="border p-2">No. HP</th>
                    <th class="border p-2">Foto Siswa</th>
                    <th class="border p-2">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <form action="{{ route('guru.delete') }}" method="post" id="form-delete{{ $user->id }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div>
                                <tr>
                                    <td class="border p-2">
                                        {{ $key + 1 }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->full_name }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->name }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->email }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->alamat }}
                                    </td>
                                    <td class="border p-2">
                                        {{ $user->no_hp }}
                                    </td>
                                    <td class="border p-2">
                                        <div class="w-36 ">
                                            <img class="w-32 h-32 mx-auto"
                                                src="{{ $user->profile_photo_path ?? 'https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg' }}"
                                                alt="profile">
                                        </div>
                                    </td>
                                    <td class="border p-2">
                                        <div class="flex space-x-2">
                                            <a href="/data-guru/{{ $user->id }}">
                                                <div
                                                    class="bg-sky-400 px-2 py-1 text-white hover:bg-sky-700 rounded-md w-min">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-6">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                        <path
                                                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            <button class="bg-red-400 px-2 py-1 text-white hover:bg-red-700 rounded-md"
                                                id="delete{{ $user->id }}" data-user="{{ $user->name }}"
                                                data-id="{{ $user->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </div>

                            <script>
                                $("#delete{{ $user->id }}").click(function(e) {
                                    const id = $(this).data('id');
                                    const dataId = document.getElementById('id');
                                    const form = document.getElementById('form-delete{{ $user->id }}');
                                    dataId.value = id;
                                    console.log(dataId.value);
                                    e.preventDefault();
                                    if (confirm(`Apakah Anda yakin ingin menghapus ${$(this).data('user')}?`)) {
                                        form.submit();
                                    } else {
                                        return false;
                                    }
                                });
                            </script>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // const sidebar = document.getElementById('sidebar');

        function toggle() {
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        }
    </script>
@endsection
