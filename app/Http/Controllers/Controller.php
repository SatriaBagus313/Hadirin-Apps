<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sidebarMenu()
    {
        if (Auth::user()->role == 'ADMIN') {
            return (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => route('dashboard'),
                    'current' => 'dashboard',
                    'icon' => '/static/dashboard.png'
                ],
                (object) [
                    'title' => 'Rekap Absen',
                    'route' => route('data-absensi'),
                    'current' => 'data-absensi',
                    'icon' => '/static/assessment.png'
                ],
                (object) [
                    'title' => 'Data Siswa',
                    'route' => route('data-guru'),
                    'current' => 'data-guru',
                    'icon' => '/static/checklist-exploration.png'
                ],
                (object) [
                    'title' => 'Data Lokasi',
                    'route' => route('data.lokasi'),
                    'current' => 'data-lokasi',
                    'icon' => '/static/map.png'
                ],
                (object) [
                    'title' => 'Data Izin',
                    'route' => route('data.izin'),
                    'current' => 'data-izin',
                    'icon' => '/static/assessment.png'
                ],
            ];
        } else {
            // Jika user biasa
            return (object) [
                (object) [
                    'title' => 'Dashboard',
                    'route' => route('home'),
                    'current' => 'home',
                    'icon' => '/static/dashboard.png'
                ],
                (object) [
                    'title' => 'Absensi',
                    'current' => 'absen/',
                    'icon' => '/static/assessment.png',
                    'child' => (object) [
                        (object) [
                            'title' => 'Absen Masuk',
                            'current' => 'masuk',
                            'route' => route('checkInOut', 'masuk'),
                        ],
                        (object) [
                            'title' => 'Absen Pulang',
                            'current' => 'pulang',
                            'route' => route('checkInOut', 'pulang'),
                        ],
                    ],
                ],
                (object) [
                    'title' => 'Info Absen',
                    'route' => route('riwayat'),
                    'current' => 'riwayat',
                    'icon' => '/static/checklist-exploration.png'
                ],
                (object) [
                    'title' => 'Riwayat Izin',
                    'route' => route('izin.index'),
                    'current' => 'izin',
                    'icon' => '/static/clock.png'
                ],
                (object) [
                    'title' => 'Profil',
                    'route' => route('profile'),
                    'current' => 'profil',
                    'icon' => '/static/profile.png'
                ],

            ];
        }

    }
}
