<?php

namespace App\Exports;

use App\Models\TypeTraining;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TypeTrainingExport implements FromCollection, WithHeadings, WithColumnWidths {
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {
        $type_trainings = DB::table( 'type_trainings' )->select( 'name', 'class', 'quota' )->get();
        return $type_trainings;
    }

    public function headings(): array {
        return [
            'Nama Pelatihan',
            'Kelas',
            'Kuota Pelatihan'
        ];
    }

    public function columnWidths(): array {
        return [
            'A' => 30,
            'B' => 15,
            'C' => 10
        ];
    }
}
