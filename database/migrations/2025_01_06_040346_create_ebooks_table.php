<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul e-book
            $table->string('penulis')->nullable(); // Penulis e-book
            $table->text('deskripsi')->nullable(); // Deskripsi e-book
            $table->string('file'); // Path ke file e-book (PDF, dll.)
            $table->string('gambar_sampul')->nullable(); // Path ke gambar sampul
            $table->integer('jumlah_halaman')->nullable(); // Jumlah halaman
            $table->string('penerbit')->nullable(); // Nama penerbit
            $table->date('tanggal_terbit')->nullable(); // Tanggal terbit e-book
            $table->string('kategori')->nullable(); // Kategori e-book (Fiksi, Nonfiksi, dll.)
            $table->string('bahasa')->default('Indonesia'); // Bahasa e-book
            $table->string('kode_buku')->unique(); // Kode unik untuk ID buku
            $table->timestamps(); // Kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebooks');
    }
}
