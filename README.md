Nama: Alfha Risqi Wicaksono NIM :362358302145
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

```

Jalankan perintah berikut untuk melakukan migrasi:

![Screenshot 2024-10-20 112611](https://github.com/user-attachments/assets/39d1e930-e6d4-4cca-81a1-9cdb3fa4fb64)

2. Membuat Controller API untuk Kategori dan Buku 
Buat controller untuk Kategori dan Buku:

![Screenshot 2024-10-20 112648](https://github.com/user-attachments/assets/bb7dd943-a45d-4fef-aa21-a53d5fd67f30)

![Screenshot 2024-10-20 112709](https://github.com/user-attachments/assets/6225a3cb-494f-49f8-9553-2fef4f6933c1)

Isi file `KategoriController.php`: 

```
<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
class KategoriController extends Controller
{
    public function index()
    {
        return Kategori::all();
    }
    public function store(Request $request)
    {
        try {
            $request->validate(['nama_kategori' => 'required|unique:kategoris']);
            $kategori = Kategori::create($request->all());
            return response()->json($kategori, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function show(string $id){}
    public function update(Request $request, string $id){}
    public function destroy(string $id){}
}
```

Isi file `BukuController.php`: 

```
<?php
namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;
class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();

        return response()->json($bukus);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);
        $buku = Buku::create($validatedData);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }
        return response()->json($buku);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'kategori_id' => 'sometimes|required|exists:kategoris,id',
        ]);
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }
        $buku->update($validatedData);

        return response()->json([
            'message' => 'Buku berhasil diupdate',
            'data' => $buku
        ]);
    }
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }
        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
```

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

![Screenshot 2024-10-20 135453](https://github.com/user-attachments/assets/54ec6d15-c566-41b2-aa6a-f8df5810941b)

B. POST Tambah Kategori Baru 
 Method: POST 
 URL: http://localhost:8000/api/kategoris 
 Body :
```
{
    "nama_kategori": "Novel"
}
```

![Screenshot 2024-10-20 135736](https://github.com/user-attachments/assets/439158b5-cb59-4b7f-b014-928a26283ec8)

C. GET Semua Buku 
 Method: GET 
 URL: http://localhost:8000/api/bukus 
 Klik Send. 

![Screenshot 2024-10-20 135835](https://github.com/user-attachments/assets/2acff550-0f37-4ccb-a8d9-fa8128ec2b06)

D. POST Tambah Buku Baru 
 Method: POST 
 URL: http://localhost:8000/api/bukus 
 Body: 
```
{
    "judul": "Laskar Pelangi",
    "penulis": "Andrea Hirata",
    "harga": 85000,
    "stok": 20,
    "kategori_id": 1
}
```

![Screenshot 2024-10-20 140222](https://github.com/user-attachments/assets/db0849b4-b28e-4f6e-ace0-798218ad6bee)

E. 
GET Buku Berdasarkan ID 
 Method: GET 
 URL: http://localhost:8000/api/bukus/1 
 Klik Send.

![Screenshot 2024-10-20 140240](https://github.com/user-attachments/assets/74440022-e505-4932-86e7-1d7a8d4685e9)

F. 
PUT Update Data Buku 
 Method: PUT 
 URL: http://localhost:8000/api/bukus/1 
 BODY 
```
{
    "judul": "Laskar Pelangi- Edisi Spesial",
    "penulis": "Andrea Hirata",
    "harga": 85000,
    "stok": 20,
    "kategori_id": 1
}
```

![Screenshot 2024-10-20 140335](https://github.com/user-attachments/assets/d454b372-ae2c-42b8-91b6-becf4e3898c3)

G. DELETE Hapus Buku 
 Method: DELETE 
 URL: http://localhost:8000/api/bukus/1 
 Klik Send.

![Screenshot 2024-10-20 140353](https://github.com/user-attachments/assets/e1ad3c02-7379-42b0-ae43-27a5c91afab0)
