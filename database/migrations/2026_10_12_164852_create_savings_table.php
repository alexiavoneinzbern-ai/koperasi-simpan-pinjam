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
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // Relasi ke tabel members
            $table->enum('type', ['Pokok', 'Wajib', 'Sukarela']);                // Jenis Simpanan
            $table->decimal('amount', 12, 2);                                   // Jumlah Nominal (Rp)
            $table->date('date');                                               // Tanggal Setor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
