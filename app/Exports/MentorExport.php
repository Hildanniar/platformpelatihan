<?php

namespace App\Exports;

use App\Models\Mentor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MentorExport implements FromCollection, WithHeadings, WithColumnWidths {
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function collection() {
    //     $mentors = DB::table( 'mentors' )->select( 'name', 'username', 'email', 'address', 'no_hp' )->get();
    //     return $mentors;
    // }

    public function collection() {
        $mentors = DB::table( 'mentors' )
        ->leftJoin( 'users', 'users.id', '=', 'mentors.user_id' )
        ->select( 'mentors.name', 'users.email', 'mentors.address', 'mentors.no_hp', 'mentors.age', 'mentors.gender', 'mentors.profession', 'mentors.no_member' )
        ->get();
        return $mentors;
    }

    public function headings(): array {
        return [
            'Nama Lengkap',
            'Email',
            'Alamat',
            'No.HP',
            'Usia',
            'Jenis Kelamin',
            'Pekerjaan',
            'No.Anggota Perpustakaan'
        ];
    }

    public function columnWidths(): array {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 45,
            'D' => 15,
            'E'=> 5,
            'F' => 15,
            'G' => 20,
            'H' => 25,
        ];
    }
}