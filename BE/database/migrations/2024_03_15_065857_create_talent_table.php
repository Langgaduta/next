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
        Schema::create('talents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('namaL');
            $table->string('namaP');
            $table->enum('gender', ['L', 'P']);
            $table->bigInteger('noHP');
            $table->string('alamat_KTP');
            $table->string('alamat_domisili');
            $table->string('pendidikan_terakhir');
            $table->string('status_pekerjaan');  
            $table->enum('jenis_pekerjaan_yang_diminati', ['Freelance', 'Fulltime Remotely', 'Fulltime Onsite', 'Hybrid']);  
            $table->string('skill_1');  
            $table->string('skill_1_waktu');  
            $table->string('skill_2');  
            $table->string('skill_2_waktu');  
            $table->enum('level', ['Junior', 'Mid-Level', 'Senior', 'Rockstar']);  
            $table->Date('waktu_assign');  
            $table->string('linkedin');  
            $table->string('github');  
            $table->string('cv');
            $table->string('password');
            $table->string('hunter');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent');
    }
};
