@extends('index')

@section('map_header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection

@section('admin-content')
    <div>
        <div id="map" class="h-screen z-0"></div>
        <div class="fixed top-0 right-0 m-4 p-2 bg-white shadow-md rounded-md md:hidden" id="hamburger" onclick="toggle()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <form action="{{ route('add.location') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $location->id ?? null }}">
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
            <div
                class="fixed mx-4 md:mx-20 bottom-8 md:absolute md:bottom-10 md:right-0 md:left-72 shadow-lg bg-white rounded-md p-4">
                <div class="flex items-center">
                    <label for="default-range" class="block mb-4 text-sm px-4 w-full">
                        <ul class="list-disc">
                            <li> Geser untuk mengubah radius </li>
                            <li> Tekan di peta untuk meletakkan titik </li>
                            <li> Tekan tombol di samping untuk menyimpan </li>
                        </ul>
                    </label>
                    <div class="w-10 h-10 p-1 mr-4 border bg-white shadow-md rounded-md border-slate-400 hover:bg-sky-200 hover:border-sky-400"
                        id="my-location" onclick="getLocation()">
                        <img src="static/pin-map.png" alt="my location">
                    </div>
                    <button
                        class="w-10 h-10 mr-4 rounded-md border border-slate-400 p-2 shadow-md hover:bg-sky-200 hover:border-sky-400"
                        id="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="flex justify-center">
                    <input id="radius" name="rad" type="range" value="50"
                        class="w-4/5 md:w-1/2 max-w-[500px] h-2 mb-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        oninput="listenRadiusChange(this.value)" min="10" max="500">
                </div>
            </div>
        </form>
    </div>

    <script>
        var oldMarker = undefined;

        const currentLat = '{{ $location->lat ?? null }}';
        const currentLng = '{{ $location->lng ?? null }}';
        const currentRad = '{{ $location->radius ?? null }}';

        const myLocationBtn = document.getElementById('my-location');

        if (currentLat && currentLng && currentRad) {
            var latitude = currentLat;
            var longitude = currentLng;
            var radius = currentRad;

        } else {
            var latitude = -6.3536019;
            var longitude = 107.2270661;
            var radius = 50;
            getLocation();
        }

        var map = L.map('map').setView([latitude, longitude], 17);
        if (currentLat && currentLng && currentRad) {
            var marker = new L.marker([latitude, longitude]).addTo(map);
            oldMarker = marker;
        }

        const lat = document.getElementById('lat');
        const lng = document.getElementById('lng');


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var circle = L.circle([latitude ?? -6.2453078, longitude ?? 107.1812406], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius,
        }).addTo(map);

        map.on('click', function(e) {
            if (map.hasLayer(oldMarker)) {
                map.removeLayer(oldMarker);
            }
            latitude = e.latlng.lat;
            longitude = e.latlng.lng;
            console.log(latitude);
            const mark = new L.marker([latitude, longitude]).addTo(map);
            oldMarker = mark;
            circle.setLatLng(e.latlng);
        })

        function listenRadiusChange(inputRadius) {
            radius = inputRadius;
            circle.setRadius(radius);
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showLocation, error);
            } else {
                var element = document.getElementById("location-allowed").innerHTML =
                    "Perangkat ini tidak mendukung akses lokasi. Coba gunakan perangkat lain.";
            }
        }

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

            circle.setLatLng([latitude, longitude]);

        }

        function error(err) {
            // Tampilkan error lokasi
            var element = document.getElementById("location-denied");
            element.classList.remove("hidden");
            // Hide ambil foto
            var element = document.getElementById("location-allowed");
            element.classList.add("hidden");
        }

        // Submit
        const submitBtn = document.getElementById('submit');

        submitBtn.addEventListener("click", async () => {
            submit();

            lat.value = latitude;
            lng.value = longitude;
        });

        async function submit() {

            const data = {
                lat: latitude,
                lng: longitude,
                rad: radius,
            };

            console.log(data.lat);

            const route = "{{ route('add.location') }}";

            fetch(route, {
                method: 'POST',
                header: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            }).then((result) => {
                // result.
            }).catch((err) => {

            });
        }

        function goToMyLocation() {
            getLocation();

        }
    </script>
@endsection
