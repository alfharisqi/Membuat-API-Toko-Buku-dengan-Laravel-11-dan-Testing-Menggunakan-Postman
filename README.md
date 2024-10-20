Nama : Alfha Risqi Wicaksono NIM : 362358302145

Tugas Mahasiswa 
1. Tambahkan Validasi: 
o Nama buku tidak boleh kosong. 
o Harga minimal Rp 1.000.

![Screenshot 2024-10-20 150217](https://github.com/user-attachments/assets/8ce557c9-655d-4fcb-b3a3-0d4982caa763)

3. Rancang Endpoint Baru: 
Buatlah satu endpoint tambahan untuk sistem toko buku, misalnya, endpoint untuk 
mencari buku berdasarkan kategori atau judul. Tantangan: Apa pertimbangan yang 
harus Anda buat saat merancang endpoint ini? Pertimbangkan aspek performa, 
skalabilitas, dan pengalaman pengguna.

Untuk membuat endpoint pencarian buku berdasarkan judul dalam sistem API toko buku, Saya bisa menambahkan endpoint ini ke dalam controller Anda di Laravel. 
Menambahkan fungsi di controller BookController:

```
public function search(Request $request)
    {
        $query = Buku::query();

        // Filter berdasarkan judul
        if ($request->has('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Ambil hasil pencarian
        $bukus = $query->get();

        return response()->json($bukus);
    }
```

Menambahkan route baru untuk endpoint ini di routes/api.php:

```
Route::get('bukus/search', [BukuController::class, 'search']);
```

Endpoint menerima parameter query melalui URL untuk mencari buku berdasarkan judulnya

![Screenshot 2024-10-20 150331](https://github.com/user-attachments/assets/2e8e85f7-35a2-4488-a0ba-d0cba22f61ba)

5. Uji API Secara Publik: 
o Gunakan ngrok atau sejenisnya untuk membuka API ke internet.

hubungkan ngrok ke api

![Screenshot 2024-10-20 162748](https://github.com/user-attachments/assets/9d7e677d-ea83-4e85-868c-4f496214f1b7)

buka url dari ngrok di website

![Screenshot 2024-10-20 160323](https://github.com/user-attachments/assets/13eca435-e8c7-448b-9695-41e2d78f4ee7)

