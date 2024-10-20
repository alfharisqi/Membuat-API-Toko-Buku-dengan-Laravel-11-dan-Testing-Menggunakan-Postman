# sampah

Praktikum Interoperabilitas: Membuat API Toko Buku dengan Laravel 11 dan Testing Menggunakan Postman 

Persiapan 
1. Instalasi Laravel 11: 
Pastikan sudah terinstal PHP, Composer, dan MySQL. 
Instal Laravel:

![Screenshot 2024-10-20 131129](https://github.com/user-attachments/assets/5701a015-73c3-4f8e-9adc-7345eaf5176d)

Konfigurasi Database: 
Buat database MySQL baru bernama 'tokobuku_db'. 
Sesuaikan file .env dengan informasi berikut:

![Screenshot 2024-10-20 111554](https://github.com/user-attachments/assets/dcc91c85-1f5c-4376-9bd2-9b19003aaf0c)

Migrasi Awal: 
Jalankan perintah berikut untuk membuat tabel default:

![Screenshot 2024-10-20 111657](https://github.com/user-attachments/assets/db2ece6a-f777-4667-9f1f-5517b09753ef)

Membuat API CRUD untuk Sistem Toko Buku 
API ini akan mengelola data buku dan kategori dengan beberapa endpoint: 
1. Kategori: Menambahkan dan menampilkan kategori buku. 
2. Buku: Mengelola informasi buku (judul, penulis, harga, stok, dan kategori).

1. Membuat Migration dan Model 
Buat migration dan model untuk Kategori dan Buku:

![Screenshot 2024-10-20 111924](https://github.com/user-attachments/assets/2bf796d3-cb98-42c0-811f-30ebe8230ac8)

![Screenshot 2024-10-20 112003](https://github.com/user-attachments/assets/a74417fc-3e8c-4f02-b383-e92cafbc5f14)

Edit file migration `create_kategoris_table.php`:

```
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};

```

Edit file migration `create_bukus_table.php`:

```
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
```

Jalankan perintah berikut untuk melakukan migrasi:

![Screenshot 2024-10-20 112611](https://github.com/user-attachments/assets/39d1e930-e6d4-4cca-81a1-9cdb3fa4fb64)

2. Membuat Controller API untuk Kategori dan Buku 
Buat controller untuk Kategori dan Buku:

![Screenshot 2024-10-20 112648](https://github.com/user-attachments/assets/bb7dd943-a45d-4fef-aa21-a53d5fd67f30)

![Screenshot 2024-10-20 112709](https://github.com/user-attachments/assets/6225a3cb-494f-49f8-9553-2fef4f6933c1)

Isi file `KategoriController.php`: 

![image](https://github.com/user-attachments/assets/c9ae0e4c-e06c-4f9b-89b3-163e7c521313)

Isi file `BukuiController.php`: 

![image](https://github.com/user-attachments/assets/3e5ba1da-db45-4a5b-b434-768208254ab3)

3. Menambahkan Route API 
Buka file `routes/api.php` dan tambahkan route berikut:
```
<?php
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('kategoris', KategoriController::class);
Route::apiResource('bukus', BukuController::class);
```

IV. Testing API dengan Postman 
1. Jalankan server Laravel

2. Testing endpoint menggunakan Postman: 
A. GET Semua Kategori 
 Method: GET 
 URL: http://localhost:8000/api/kategoris 
 Klik Send untuk melihat hasil. 

![Screenshot 2024-10-20 135453](https://github.com/user-attachments/assets/9615bc20-baa7-4341-a886-631a3cb3e946)

B. POST Tambah Kategori Baru 
 Method: POST 
 URL: http://localhost:8000/api/kategoris 
 Body :


![Screenshot 2024-10-20 135736](https://github.com/user-attachments/assets/1aab6573-29d6-4556-8bb9-a0d583410e0d)

C. GET Semua Buku 
 Method: GET 
 URL: http://localhost:8000/api/bukus 
 Klik Send. 

![Screenshot 2024-10-20 135835](https://github.com/user-attachments/assets/c2f2ad51-2756-451e-b55d-8f8603638a1c)

D. POST Tambah Buku Baru 
 Method: POST 
 URL: http://localhost:8000/api/bukus 
 Body: 

![Screenshot 2024-10-20 140222](https://github.com/user-attachments/assets/1f9ab90a-ce1e-432a-9d48-9f48c4cc644b)

E. 
GET Buku Berdasarkan ID 
 Method: GET 
 URL: http://localhost:8000/api/bukus/1 
 Klik Send.

![Screenshot 2024-10-20 140240](https://github.com/user-attachments/assets/111afbb5-909c-4a91-9a6d-65fb7a1a1147)

F. 
PUT Update Data Buku 
 Method: PUT 
 URL: http://localhost:8000/api/bukus/1 
 BODY 

![Screenshot 2024-10-20 140335](https://github.com/user-attachments/assets/917b4979-46c4-4b3a-a253-e26ecc2828c3)

G. DELETE Hapus Buku 
 Method: DELETE 
 URL: http://localhost:8000/api/bukus/1 
 Klik Send.

![Screenshot 2024-10-20 140353](https://github.com/user-attachments/assets/23616249-f009-4364-88fe-8786793e67af)






