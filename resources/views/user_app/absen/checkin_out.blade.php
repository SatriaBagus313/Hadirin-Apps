@extends('index')

@section('map_header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection

@section('main-content')
    <div class="bg-green-300 w-full pt-2">
        <div class="text-right">
            <a href="{{ route('logout') }}" class="bg-gray-300 px-3 py-1">Logout</a>
        </div>
        <div class="flex mt-4 bg-white rounded-sm mx-4 px-6 py-4">
            <div class="w-2/3 space-y-4">
                <span class="bg-yellow-100 px-4 py-2 text-xl">
                    Siswa : {{ Auth::user()->full_name }}
                </span>
                <div id="date" class=""></div>
                <div class="space-y-4" id="masuk_view">
                    <div class="flex space-x-4">
                        <div class="w-1/3 h-64">
                            {{-- <button class="flex-col w-1/3 md:w-full md:h-64" type="button" data-modal-toggle="modal-id"> --}}
                            <div class="rounded-md border content-center h-full mx-auto">
                                <svg id="camera-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" class="size-12 mx-auto md:size-32">
                                    <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                    <path fill-rule="evenodd"
                                        d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <img src="" alt="" class="hidden mx-auto h-64" id="image">
                            </div>
                            {{-- </button> --}}
                        </div>
                        <div id="map" class="w-full h-64 z-0"></div>
                    </div>
                    <button class="bg-red-400 text-white border border-black px-3 py-1 hover:bg-red-600" type="button"
                        data-modal-toggle="modal-id">
                        Ambil Foto
                    </button>
                    <button onclick="upload()"
                        class="w-full bg-blue-500 hover:bg-blue-600 disabled:hover:bg-none disabled:bg-slate-500 mt-4 p-1 rounded-md text-white text-center cursor-pointer disabled:cursor-not-allowed"
                        id="absen-button" disabled>
                        <div id="absen-btn" class="">
                            Simpan Absen {{ $jenis }}
                        </div>
                    </button>
                </div>

                <div class="space-y-4 w-2/3 hidden" id="izin_view">
                    <form action="/submit_izin" method="post" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="keterangan" id="keterangan_izin">
                        <div class="space-y-2">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="border border-slate-200 w-full focus:outline-sky-200 placeholder:italic text-sm"
                                required />
                        </div>
                        <div class="space-y-2">
                            <label for="surat">Upload Surat Pernyataan</label>
                            <div>
                                <input type="file" name="suket" id="suket"
                                    accept="image/png, image/gif, image/jpeg" required>
                            </div>
                        </div>
                        <div>
                            <textarea name="catatan" id="catatan" cols="30" rows="2" class="w-full" placeholder="Tambahkan Catatan..."
                                required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="bg-black px-3 py-1 text-white">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Dropdown select jenis absen --}}
            <div class="ml-4 w-1/3">
                <select name="keterangan" id="keterangan" onchange="change(this.value)">
                    <option value="masuk">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
            </div>
        </div>
    </div>
    <div class="h-screen md:flex md:items-center">
        <div id="maps" class="h-screen w-full z-0"></div>
        <div class="p-4 pt-2 m-4 rounded-xl absolute bottom-0 bg-white shadow-lg right-0 left-0 md:static">
            <div class="text-justify hidden" id="location-denied">Anda harus mengaktifkan lokasi untuk menggunakan fitur
                ini.
                Silahkan izinkan penggunaan lokasi di pengaturan browser anda.
            </div>
            <div id="location-allowed">
                <div class="text-right pb-2">
                    <div class="text-sm" id="time"></div>
                </div>
                <div class="flex md:block">
                    <div class="">
                        <div>Halo, {{ $user->full_name }}</div>
                        <div>Anda akan absen <span class="font-bold capitalize text-blue-700">{{ $jenis }}</span>
                        </div>
                        <div class="text-sm">pastikan anda berada di dalam area lokasi untuk melakukan absen.</div>
                    </div>
                    <button class="flex-col w-1/3 md:w-full md:h-auto md:my-4" type="button" data-modal-toggle="modal-id">
                        <div class="rounded-md border content-center h-full mx-auto">
                            <svg id="camera-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-12 mx-auto md:size-32">
                                <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                <path fill-rule="evenodd"
                                    d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <img src="" alt="" class="hidden mx-auto" id="image">
                        </div>
                    </button>
                </div>
                <button onclick="upload()"
                    class="w-full bg-blue-500 hover:bg-blue-600 disabled:hover:bg-none disabled:bg-slate-500 mt-4 p-1 rounded-md text-white text-center cursor-pointer disabled:cursor-not-allowed"
                    id="absen-button" disabled>
                    <div id="absen-btn" class="">
                        Absen {{ $jenis }}
                    </div>
                </button>
            </div>
        </div>

    {{-- Camera modal --}}
    <div id="modal-id"
        class="hidden fixed z-20 inset-0 overflow-y-auto bg-gray-900 bg-opacity-75 p-4 w-full md:p-12 mx-auto">
        <div class="modal-content bg-white rounded-xl shadow p-4 w-1/2 mx-auto">
            <video id="video" class="w-full max-w-96 max-h-96 mx-auto rounded-lg" autoplay muted></video>
            <canvas id="canvas" width="256" height="256"
                class="hidden w-64 h-auto max-w-96 max-h-96 mx-auto rounded-lg"></canvas>
            <button id="request-button" class="hidden">Request Camera</button>
            <button id="capture-button" class="w-full mt-4 flex">
                <div class="w-12 h-12 rounded-full bg-white border-2 border-slate-800 content-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mx-auto"
                        id="take">
                        <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                        <path fill-rule="evenodd"
                            d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 hidden mx-auto" id="retake">
                        <path fill-rule="evenodd"
                            d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="hidden w-12 h-12 rounded-full bg-white border-2 border-slate-800 content-center mx-auto"
                    id="done">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 mx-auto">
                        <path fill-rule="evenodd"
                            d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>

            <button data-modal-toggle="modal-id" type="button" class="btn btn-outline close-modal-btn">Close</button>
        </div>
    </div>
    {{-- </div>
    </div> --}}

    <script>
        const absenView = document.getElementById('masuk_view');
        const izinView = document.getElementById('izin_view');
        const keteranganIzin = document.getElementById('keterangan_izin');

        const keteranganSelect = document.getElementById('keterangan');

        function change(v) {

            if (v == 'izin') {
                keteranganIzin.value = v;
                absenView.classList.add('hidden');
                izinView.classList.remove('hidden');
                izinView.classList.add('block');
            } else if (v == 'sakit') {
                absenView.classList.add('hidden');
                izinView.classList.remove('hidden');
                keteranganIzin.value = v;
            } else {
                absenView.classList.remove('hidden');
                izinView.classList.add('hidden');
                keteranganIzin.value = v;
            }
        }

        var latitude = '{{ $location->lat ?: 0 }}';
        var longitude = '{{ $location->lng ?: 0 }}';
        var radius = '{{ $location->radius ?: 50 }}';
        var map = L.map('map').setView([latitude, longitude], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var circle = L.circle([latitude, longitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);

        function isInCircle(lat, lng) {
            var distance = map.distance(circle.getLatLng(), L.latLng(lat, lng));
            return distance < circle.getRadius();
        }

        var insideRadius = false;
        var oldMarker = undefined;

        function showTime() {
            var WIBTime = moment().format('LTS');
            var date = moment().locale('id').format('dddd, Do MMMM YYYY');
            // document.getElementById('time').innerHTML = WIBTime;
            document.getElementById('date').innerHTML = date;
        }

        setInterval(showTime, 1000);

        function showLocation(position) {
            // Extract latitude dan longitude
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;

            if (map.hasLayer(oldMarker)) {
                map.removeLayer(oldMarker);
            }

            var marker = new L.marker([latitude, longitude]).addTo(map);
            oldMarker = marker;
            map.panTo(new L.latLng(latitude, longitude));

            insideRadius = isInCircle(latitude, longitude);
        }

        function error(err) {
            // Tampilkan error lokasi
            var element = document.getElementById("location-denied");
            element.classList.remove("hidden");
            // Hide ambil foto
            var element = document.getElementById("location-allowed");
            element.classList.add("hidden");
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showLocation, error);
            } else {
                console.log('location not supported');
                var element = document.getElementById("location-allowed").innerHTML =
                    "Perangkat ini tidak mendukung akses lokasi. Coba gunakan perangkat lain.";
            }
        }

        $(document).ready(function() {
            setInterval(getLocation, 2000);
        });
    </script>

    {{-- For camera --}}
    <script>
        var imageData = null;

        function showDialog() {
            console.log('show dialog');
        }

        const modal = document.getElementById('modal-id');
        const modalBtn = document.querySelector('[data-modal-toggle="modal-id"]');
        const closeBtn = document.querySelector('.close-modal-btn');

        const request = document.getElementById("request-button");
        const button = document.getElementById("capture-button");
        const video = document.getElementById("video");
        const canvas = document.getElementById("canvas");
        const takeBtn = document.getElementById("take");
        const retakeBtn = document.getElementById("retake");
        const doneBtn = document.getElementById("done");
        const absenBtn = document.getElementById("absen-button");
        const cameraIcon = document.getElementById('camera-icon');
        const image = document.getElementById('image');
        var stream = undefined;

        // Function to toggle modal visibility
        function toggleModal() {
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) {
                video.classList.remove('hidden');
                takeBtn.classList.remove('hidden');
                canvas.classList.add('hidden');
                retakeBtn.classList.add('hidden');
                doneBtn.classList.add('hidden');
                stream = navigator.mediaDevices.getUserMedia({
                    video: true
                }).then((result) => {
                    video.srcObject = result;
                }).catch((err) => {

                });
            } else {
                if (stream || (video.srcObject != null)) {
                    video.srcObject.getTracks().forEach((track) => track.stop());
                    video.srcObject = null;
                }
                // video.classList.remove('hidden');
                takeBtn.classList.remove('hidden');
                canvas.classList.add('hidden');
                retakeBtn.classList.add('hidden');
                doneBtn.classList.add('hidden');
            }
        }

        // Event listeners
        modalBtn.addEventListener('click', toggleModal);
        closeBtn.addEventListener('click', toggleModal);


        request.addEventListener("click", async () => {
            console.log('requesting');
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
            } catch (error) {
                console.log(error);
            }
        })

        button.addEventListener("click", async () => {
            try {
                // // Request camera access
                // const stream = await navigator.mediaDevices.getUserMedia({
                //     video: true
                // });
                // video.srcObject = stream;

                // Capture image on button click
                // button.addEventListener("click", () => {
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                // Optional: Get the captured image data
                imageData = canvas.toDataURL('image/jpeg');
                // You can change the format here (e.g., 'image/png')
                // Now you can use the imageData for further processing (e.g., display, upload to server)
                // console.log(imageData); // For demonstration purposes
                if (stream) {
                    console.log('stopping');

                    video.srcObject.getTracks().forEach((track) => track.stop());
                    video.srcObject = null;
                    video.classList.add('hidden');
                    takeBtn.classList.add('hidden');
                    canvas.classList.remove('hidden');
                    retakeBtn.classList.remove('hidden');
                    doneBtn.classList.remove('hidden');
                    cameraIcon.classList.add('hidden');
                    image.classList.remove('hidden');
                    image.src = imageData;
                    image.classList.remove('hidden');
                }
                // });
            } catch (error) {
                console.error("Error accessing camera:", error);
            }
        });

        retakeBtn.addEventListener("click", async () => {
            try {
                video.classList.remove('hidden');
                takeBtn.classList.remove('hidden');
                canvas.classList.add('hidden');
                retakeBtn.classList.add('hidden');
                doneBtn.classList.add('hidden');

                stream = navigator.mediaDevices.getUserMedia({
                    video: true
                }).then((result) => {
                    video.srcObject = result;
                }).catch((err) => {

                });

            } catch (error) {
                console.log(error);
            }
        })

        doneBtn.addEventListener("click", toggleModal)

        function checkStatus() {
            // TODO Perlu diperbaiki, harus hapus !
            if (imageData && insideRadius) {
                return true;
            } else {
                return false;
            }
        }

        function updateAbsenButton() {
            if (checkStatus() == true) {
                absenBtn.disabled = false;
            } else {
                console.log(`belum di area atau belum upload foto`);
            }
        }

        $(document).ready(function() {
            setInterval(updateAbsenButton, 1000);
        });

        function upload() {
            if (checkStatus) {
                console.log('upload sekarang');
                // change this if controller ready
                // Replace 'your_image_data' with the actual image data string

                const data = {
                    imageData: imageData,
                    lat: latitude,
                    lng: longitude,
                    jenis: '{{ $jenis }}'
                };


                var routePost = '{{ $jenis }}';
                console.log(`routenya ${routePost}`);

                fetch(routePost, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        response.json().then((res) => {
                            console.log(`responsenya ${JSON.stringify(res)}`);
                            if (res.success === true) {
                                console.log('redirecting');
                                window.location.replace(res.redirect);
                            }
                        })
                        if (!response.ok) {
                            throw new Error("HTTP error " + response.status);
                        }
                    })
                    .then(data => {
                        console.log('Success:', data);
                        // Handle successful response from the server (optional)
                    })
                    .catch(error => {
                        console.log(data);
                        console.error('Error:', error);
                        // Handle errors during data sending (optional)
                    });
            }
        }
    </script>
@endsection
