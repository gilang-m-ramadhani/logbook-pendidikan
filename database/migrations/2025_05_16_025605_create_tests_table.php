<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['pre-test', 'post-test']);
            $table->string('judul');
            $table->text('deskripsi');
            $table->json('soal'); // {soal1: {pertanyaan: '', opsi: [], jawaban: ''}}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
