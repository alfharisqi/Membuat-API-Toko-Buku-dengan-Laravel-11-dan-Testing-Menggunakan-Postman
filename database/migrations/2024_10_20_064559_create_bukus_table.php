<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
{
    Schema::create('bukus', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('penulis');
        $table->decimal('harga', 8, 2);
        $table->integer('stok');
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
