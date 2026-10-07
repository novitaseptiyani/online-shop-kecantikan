# Online Shop Kecantikan

Website toko online produk makeup dan skincare dengan katalog produk,
login/registrasi, pemesanan, dan panel admin.

## Tampilan
![Beranda](screenshots/beranda.png)
![Katalog](screenshots/katalog.png)
![Produk](screenshots/produk.png)

## Fitur Utama
- Katalog produk berdasarkan brand dan kategori
- Halaman berita dan galeri
- Login dan registrasi dengan password ter-hash (`password_verify`)
- Dua peran pengguna: user dan admin
- Pemesanan produk dan formulir pesan ke admin
- Panel admin untuk mengelola produk, brand, berita, galeri,
  pemesanan, pesan, dan pengguna (tambah, ubah, hapus)
- Query memakai prepared statement (`mysqli_prepare`)

## Tech Stack
HTML, CSS, JavaScript, PHP Native, MySQL

## Peran Saya
Proyek individu.
Saya mengerjakan seluruhnya sendiri: desain tampilan, halaman frontend,
logika PHP, dan struktur database.

## Cara Menjalankan
Perlu XAMPP (Apache dan MySQL).

1. Salin folder repo ke `C:\xampp\htdocs\online-shop-kecantikan`.
2. Nyalakan **Apache** dan **MySQL** di XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`, lalu **Import** file
   `database.sql`. Database `20222_wp2_412023015` akan dibuat otomatis.
4. Buka `http://localhost/online-shop-kecantikan/`.
5. Daftar akun lewat halaman registrasi. Untuk menjadikannya admin,
   buka tabel `user` di phpMyAdmin dan ubah kolom `role` menjadi `admin`.

Katalog akan kosong sampai produk ditambahkan lewat panel admin.
