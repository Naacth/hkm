<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Tech Conference 2024',
                'description' => 'Konferensi teknologi terbesar tahun ini yang menghadirkan pembicara dari berbagai perusahaan teknologi ternama.',
                'image' => 'events/CBlx1vSWOnb7SqIVVVSv3TnBgLAEiYvXgr1J8yOF.png',
                'date' => now()->addDays(30)->format('Y-m-d'),
                'location' => 'Aula Utama Universitas Yatsi Madani',
                'is_paid' => false,
                'price' => null,
                'google_form_link' => 'https://forms.gle/example1',
            ],
            [
                'title' => 'Workshop Machine Learning',
                'description' => 'Workshop intensif tentang machine learning dan artificial intelligence untuk mahasiswa yang ingin mendalami AI.',
                'image' => 'events/fWn9GhEk3CsBLX4uwDJUGVuuscmlJ7ydrDuBr0rQ.png',
                'date' => now()->addDays(45)->format('Y-m-d'),
                'location' => 'Lab Komputer UYM',
                'is_paid' => true,
                'price' => 150000,
                'google_form_link' => 'https://forms.gle/example2',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
