<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestResult extends Model
{
    protected $fillable = [
    'test_id',
    'user_id',
    ];
     // Definisikan relasi ke Test
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    // Definisikan relasi ke User (peserta test)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
