<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeris = [
            [
                'title' => 'Workshop Web Development',
                'description' => 'Kegiatan workshop pengembangan web yang diikuti oleh mahasiswa Teknik Informatika untuk meningkatkan skill programming.',
                'image' => 'galeris/EvcAd79phGXSMdZzr4CeIDwgJa6sGd0Hq2kdTKcd.png',
            ],
            [
                'title' => 'Seminar Teknologi Terkini',
                'description' => 'Seminar tentang perkembangan teknologi terbaru dalam dunia IT dan peluang karir di masa depan.',
                'image' => 'galeris/VvYdjffJaeByHTcJdqgAiQISogctSJgyveJarqee.png',
            ],
            [
                'title' => 'Hackathon HIMAKOM 2024',
                'description' => 'Kompetisi programming 24 jam untuk mengembangkan solusi inovatif dalam bidang teknologi informasi.',
                'image' => 'galeris/yrpWLYavz8WkgfL4IZcFVcFhCPGfEwrWdpaj4eq9.png',
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}
