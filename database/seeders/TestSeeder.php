<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestSeeder extends Seeder
{
   public function run(): void
{
    // Data pre-test dengan struktur yang sesuai
    $preTestData = [
        'jenis' => 'pre-test',
        'judul' => 'Pre-Test Semester 1',
        'deskripsi' => 'Test awal untuk mengukur pengetahuan dasar',
        'acak_soal' => true,
        'acak_pilihan' => true,
        'soal' => [], // Array kosong untuk kolom NOT NULL
        'paket_soal' => [
            [
                'nama_paket' => 'Paket A',
                'soal' => [
                    [
                        'pertanyaan' => 'Apa yang dimaksud dengan anamnesis?',
                        'pilihan' => [
                            ['text' => 'Proses pembedahan', 'benar' => false],
                            ['text' => 'Pengambilan riwayat kesehatan pasien', 'benar' => true],
                            ['text' => 'Pemeriksaan laboratorium', 'benar' => false],
                            ['text' => 'Terapi fisik', 'benar' => false],
                        ],
                        'bobot' => 1,
                    ]
                ]
            ]
        ]
    ];

    // Data post-test
    $postTestData = [
        'jenis' => 'post-test',
        'judul' => 'Post-Test Semester 1',
        'deskripsi' => 'Test akhir untuk mengukur pencapaian belajar',
        'acak_soal' => true,
        'acak_pilihan' => true,
        'soal' => [], // Array kosong untuk kolom NOT NULL
        'paket_soal' => null // NULL untuk kolom nullable
    ];

    // Insert data
    Test::create($preTestData);
    Test::create($postTestData);
}
}

