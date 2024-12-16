@extends('index')

@section('admin-content')
    <div class="mx-4 my-4">
        <div class="mx-auto max-w-[600px]">
            <form action="{{ isset($user) ? route('update-guru') : route('tambah-guru') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $user->id ?? '' }}">
                <div class="mt-4 flex relative w-fit mx-auto">
                    <img src="{{ $user->profile_photo_path ?? 'https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg' }}"
                        alt="avatar" class="mx-auto bg-yellow-400 object-cover rounded-full h-28 w-28">
                </div>

                <div class="px-4 mt-4 space-y-4">
                    <div class="space-y-2">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                            class="border rounded-sm w-full placeholder:text-sm p-2"
                            placeholder="Masukkan nama lengkap siswa . . ." value="{{ $user->name ?? '' }}" required
                            autofocus>
                    </div>
                    <div class="space-y-2">
                        <label for="full_name">Nama Panggilan</label>
                        <input type="text" name="full_name" id="full_name"
                            class="border rounded-sm w-full placeholder:text-sm p-2"
                            placeholder="Masukkan nama panggilan siswa . . ." value="{{ $user->full_name ?? '' }}" required>
                    </div>
                    <div class="space-y-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="border rounded-sm w-full placeholder:text-sm p-2" placeholder="Masukkan email siswa . . ."
                            value="{{ $user->email ?? '' }}" required>
                    </div>
                    <div class="space-y-2">
                        <div>Jenis Kelamin</div>
                        <div class="flex space-x-2">
                            <div>
                                <input type="radio" name="gender" id="laki-laki" value="L"
                                    class="border rounded-sm w-full placeholder:text-sm p-2"
                                    {{ isset($user) ? ($user->jenis_kelamin == 'L' ? 'checked' : null) : null }} required>
                            </div>
                            <label for="laki-laki">Laki-laki</label>
                        </div>
                        <div class="flex space-x-2">
                            <div>
                                <input type="radio" name="gender" id="perempuan" value="P"
                                    class="border rounded-sm w-full placeholder:text-sm p-2"
                                    {{ isset($user) ? ($user->jenis_kelamin == 'P' ? 'checked' : null) : null }} required>
                            </div>
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="border rounded-sm w-full placeholder:text-sm p-2"
                            placeholder="Masukkan alamat siswa . . ." value="{{ $user->alamat ?? '' }}" required>
                    </div>
                    <div class="space-y-2">
                        <label for="hp">No. HP</label>
                        <input type="text" name="hp" id="hp"
                            class="border rounded-sm w-full placeholder:text-sm p-2"
                            placeholder="Masukkan nomor hp siswa . . ." value="{{ $user->no_hp ?? '' }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="email">Kata Sandi</label>
                        <div class="flex">
                            <input type="password" name="password" id="password"
                                class="border rounded-sm w-full placeholder:text-sm p-2"
                                placeholder="Masukkan password sementara . . .">
                            <div class="content-center" id="visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 ml-2" id="visibility-on">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6 ml-2 hidden" id="visibility-off">
                                    <path
                                        d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                    <path
                                        d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                    <path
                                        d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-sky-400 px-4 py-2 rounded-md hover:bg-sky-300">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const password = document.getElementById('password');
            const visibility = document.getElementById('visibility');
            const visibilityOn = document.getElementById('visibility-on');
            const visibilityOff = document.getElementById('visibility-off');

            function toggleVIsibility() {
                if (visibilityOn.classList.contains('hidden')) {
                    visibilityOn.classList.remove('hidden');
                    visibilityOff.classList.add('hidden');
                    password.type = 'password';
                } else {
                    visibilityOn.classList.add('hidden');
                    visibilityOff.classList.remove('hidden');
                    password.type = 'text';
                }
            }

            visibility.addEventListener("click", toggleVIsibility);
        })
    </script>
@endsection
