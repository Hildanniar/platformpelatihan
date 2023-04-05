<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings, WithColumnWidths {
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {
        $users = DB::table( 'users' )->select( 'name', 'email', 'age', 'address', 'no_hp', 'gender', 'profession', 'no_member' )->get();
        return $users;
    }

    public function headings(): array {
        return [
            'Nama Lengkap',
            'Email',
            'Usia',
            'Alamat',
            'No.HP',
            'Jenis Kelamin',
            'Pekerjaan',
            'No.Anggota Perpustakaan',
        ];
    }

    public function columnWidths(): array {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 6,
            'D' => 45,
            'E' => 20,
            'F' => 15,
            'G' => 30,
            'H' => 25,
        ];
    }
}

