<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Test extends Model
{
    protected $fillable = [
        'jenis',
        'judul',
        'deskripsi',
        'soal',
        'paket_soal',
        'acak_soal',
        'acak_pilihan'
];
    protected $casts = [
    'soal' => 'array',
    'paket_soal' => 'array',
    'acak_soal' => 'boolean',
    'acak_pilihan' => 'boolean',
];

public function getRandomPaket()
{
    $paket = $this->paket_soal;
    return $paket[array_rand($paket)];
}

public function prepareSoalForUser($paket)
{
    $soal = $paket['soal'];

    if ($this->acak_soal) {
        shuffle($soal);
    }

    foreach ($soal as &$item) {
        if ($this->acak_pilihan) {
            shuffle($item['pilihan']);
        }
    }

    return $soal;
}

// Accessor untuk menghitung jumlah paket
protected function paketSoalCount(): Attribute
{
    return Attribute::make(
        get: fn ($value, $attributes) => count(json_decode($attributes['paket_soal'], true))
    );
}
}
