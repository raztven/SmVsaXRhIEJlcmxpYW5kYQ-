<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Update Project UKK - Fitur Peminjam & Petugas (April 2026)

Berikut adalah ringkasan perbaikan dan penambahan fitur yang telah diimplementasikan:

### 1. Modul Peminjam
- **Filter Riwayat Mandiri**: Halaman riwayat peminjaman kini hanya menampilkan data milik akun yang sedang login (`Auth::id()`), sehingga privasi data antar user terjaga.
- **Form Peminjaman Baru**: 
  - Menggunakan elemen `<select>` (dropdown) untuk memilih alat secara ringkas.
  - Validasi stok otomatis: User tidak bisa meminjam melebihi stok yang tersedia.
  - Tanggal pinjam otomatis di-set ke hari ini (readonly).
- **Sistem Pengembalian User**: User dapat melakukan aksi "Kembalikan" langsung dari halaman riwayat. Sistem akan otomatis menambah kembali stok alat di database.
- **Log Aktivitas**: Setiap pengajuan pinjaman dan pengembalian dicatat secara otomatis ke tabel `log_aktivitas` untuk keperluan audit (sesuai standar fitur Admin).

### 2. Modul Petugas
- **Fix Error View**: Memperbaiki error `View [petugas.peminjaman.konfirmasi] not found` dengan membuat file view konfirmasi yang baru.
- **Proses Konfirmasi**: Petugas kini dapat menyetujui atau menolak pengajuan peminjaman melalui halaman konfirmasi yang telah diperbaiki.
- **Integrasi Navigasi**: Penambahan menu "Peminjaman" pada sidebar (`layouts.jam`) untuk memudahkan navigasi user peminjam.

### 3. Teknis & Kode
- **Simplifikasi Route**: Membersihkan file `routes/web.php` dari parameter yang tidak diperlukan agar struktur aplikasi lebih bersih (*Clean Code*).
- **Otomasi Database**: Penggunaan method `increment()` dan `decrement()` pada Eloquent untuk menjaga sinkronisasi stok barang secara *real-time*.

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
