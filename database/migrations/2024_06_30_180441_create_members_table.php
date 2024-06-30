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
            $table->id('id_member');
            $table->string('nama_member', 250);
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_stop')->nullable();
            $table->date('tgl')->nullable();
            $table->unsignedBigInteger('id_chanel');
            $table->string('lama_sewa', 100)->nullable();
            $table->integer('total')->nullable();
            $table->string('harga_permenit', 100);
            $table->integer('dibayar')->nullable();
            $table->enum('status', ['N', 'B', 'Y']);
            $table->timestamps();

            $table->foreign('id_chanel')->references('id_chanel')->on('chanels')->onDelete('cascade');
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
