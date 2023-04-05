<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromCollection, WithHeadings, WithColumnWidths {
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function collection() {
    //     $users = DB::table( 'index' )->select( 'name', 'email', 'address', 'no_hp', 'class' )->get();
    //     return $users;
    // }

    public function collection() {
        $participants = DB::table( 'participants' )
        ->leftJoin( 'users', 'users.id', '=', 'participants.id_user' )
        ->select( 'participants.name', 'participants.email', 'participants.address', 'participants.no_hp', 'participants.class', 'users.age', 'users.gender', 'users.profession', 'users.no_member' )
        ->get();
        return $participants;
    }

    public function headings(): array {
        return [
            'Nama Lengkap',
            'Email',
            'Alamat',
            'No.HP',
            'Kelas',
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
            'E'=> 15,
            'F' => 5,
            'G' => 20,
            'H' => 25,
            'I' => 20,
        ];
    }
}
