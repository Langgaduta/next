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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('namaL');
            $table->string('namaP');
            $table->enum('gender', ['Laki-Laki', 'Perepuan']);
            $table->text('alamat');
            $table->bigInteger('noHP');
            $table->string('ig');
            $table->string('nama_perusahaan_saat_ini');  
            $table->string('bidang_pekerjaan');  
            $table->string('rekening');  
            $table->string('ID_referral');  
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
