<?php

namespace App\Exports;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScheduleExport implements FromCollection, WithHeadings, WithColumnWidths {
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {
        $schedules = DB::table( 'schedules' )
        ->leftJoin( 'type_trainings', 'type_trainings.id', '=', 'schedules.type_training_id' )
        ->select( 'type_trainings.name', 'schedules.start_date', 'schedules.end_date', 'schedules.start_time', 'schedules.end_time' )
        ->get();
        return $schedules;
    }

    public function headings(): array {
        return [
            'Jenis Pelatihan',
            'Tanggal Mulai',
            'Tanggal Akhir',
            'Jam Mulai',
            'Jam Akhir'
        ];
    }

    public function columnWidths(): array {
        return [
            'A' => 30,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15
        ];
    }
}
