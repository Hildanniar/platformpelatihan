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
        ->leftJoin( 'users', 'users.id', '=', 'participants.user_id' )
        ->select( 'participants.name', 'users.email', 'participants.address', 'participants.no_hp', 'participants.age', 'participants.gender', 'participants.profession', 'participants.no_member' )
        ->get();
        return $participants;
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
            'F' => 20,
            'G' => 25,
            'H' => 20,

        ];
    }
}