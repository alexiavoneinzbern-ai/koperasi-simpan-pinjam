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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_code')->unique(); // Kode Anggota (misal: ANG-001)
            $table->string('name');                 // Nama Lengkap Anggota
            $table->text('address');              // Alamat
            $table->string('phone');               // Nomor Telepon/HP
            $table->date('join_date');             // Tanggal Bergabung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
