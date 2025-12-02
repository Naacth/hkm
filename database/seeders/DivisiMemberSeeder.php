<?php

namespace Database\Seeders;

use App\Models\DivisiMember;
use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first divisi
        $divisi = Divisi::first();
        
        if (!$divisi) {
            $this->command->info('No divisi found. Please create a divisi first.');
            return;
        }

        $members = [
            [
                'divisi_id' => $divisi->id,
                'name' => 'Ahmad Rizki',
                'position' => 'Ketua Divisi',
                'batch' => '2022',
                'photo' => null,
            ],
            [
                'divisi_id' => $divisi->id,
                'name' => 'Siti Nurhaliza',
                'position' => 'Sekretaris',
                'batch' => '2022',
                'photo' => null,
            ],
            [
                'divisi_id' => $divisi->id,
                'name' => 'Budi Santoso',
                'position' => 'Bendahara',
                'batch' => '2023',
                'photo' => null,
            ],
            [
                'divisi_id' => $divisi->id,
                'name' => 'Dewi Kartika',
                'position' => 'Anggota',
                'batch' => '2023',
                'photo' => null,
            ],
            [
                'divisi_id' => $divisi->id,
                'name' => 'Eko Prasetyo',
                'position' => 'Anggota',
                'batch' => '2024',
                'photo' => null,
            ],
        ];

        foreach ($members as $member) {
            DivisiMember::create($member);
        }
    }
}