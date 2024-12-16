<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    public $month;
    public $year;

    public function __construct(string $month, string $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama',
            'Tanggal',
            'Waktu',
            'Jenis',
            'Latitude',
            'Longitude',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = DB::select("SELECT u.id as user_id, u.full_name, 
                    DATE_FORMAT(a.created_at, '%d-%m-%Y') as Tanggal, 
                    DATE_FORMAT(a.created_at, '%H:%i') as Jam,
                    a.jenis, a.lat, a.lng
                    FROM `absensis` a inner join users u 
                    where month(a.created_at) = $this->month and year(a.created_at) = $this->year
                    order by a.created_at asc;");

                    // dd(json_encode($data));

        return collect($data);
    }
}
