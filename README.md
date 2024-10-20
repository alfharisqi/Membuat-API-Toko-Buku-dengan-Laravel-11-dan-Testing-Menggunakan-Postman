# sampah

Praktikum Interoperabilitas: Membuat API Toko Buku dengan Laravel 11 dan Testing Menggunakan Postman 

Persiapan 
1. Instalasi Laravel 11: 
Pastikan sudah terinstal PHP, Composer, dan MySQL. 
Instal Laravel:

![Screenshot 2024-10-20 131129](https://github.com/user-attachments/assets/e58bd4c7-651c-4860-aa76-0e0ad111e629)

Konfigurasi Database: 
Buat database MySQL baru bernama 'tokobuku_db'. 
Sesuaikan file .env dengan informasi berikut:

![Screenshot 2024-10-20 111554](https://github.com/user-attachments/assets/27bee590-0870-4314-a964-fb14587948a8)

Migrasi Awal: 
Jalankan perintah berikut untuk membuat tabel default:

![Screenshot 2024-10-20 111657](https://github.com/user-attachments/assets/28e3a4a9-bac1-4013-b6a4-47b09a05495d)

Membuat API CRUD untuk Sistem Toko Buku 
API ini akan mengelola data buku dan kategori dengan beberapa endpoint: 
1. Kategori: Menambahkan dan menampilkan kategori buku. 
2. Buku: Mengelola informasi buku (judul, penulis, harga, stok, dan kategori).

1. Membuat Migration dan Model 
Buat migration dan model untuk Kategori dan Buku:

![Screenshot 2024-10-20 140859](https://github.com/user-attachments/assets/d5d60ef4-737f-4863-8a9c-208c43e39e2f)

![Screenshot 2024-10-20 140911](https://github.com/user-attachments/assets/e1e29391-c19c-4e5a-befe-d944fddd5884)

Edit file migration `create_kategoris_table.php`:

![Screenshot 2024-10-20 141028](https://github.com/user-attachments/assets/d779cbee-3428-4a12-9e62-a295c4805776)

Edit file migration `create_bukus_table.php`:

![image](https://github.com/user-attachments/assets/56ba3204-b044-41eb-ba69-03d37a1aa1e4)

Jalankan perintah berikut untuk melakukan migrasi:

![Screenshot 2024-10-20 141241](https://github.com/user-attachments/assets/f3016591-34cc-4c79-9f2b-defa8b5f6bb6)

2. Membuat Controller API untuk Kategori dan Buku 
Buat controller untuk Kategori dan Buku:

![image](https://github.com/user-attachments/assets/c36c6219-9b82-49c3-b0b1-2d000172c84f)

Isi file `KategoriController.php`: 


Isi file `BukuiController.php`: 


3. Menambahkan Route API 
Buka file `routes/api.php` dan tambahkan route berikut:


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






