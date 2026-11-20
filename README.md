# SISTEM INFORMASI ABSENSI DIGITAL SMAN 1 JENAMAS

Sistem Informasi Absensi Digital SMAN 1 Jenamas merupakan aplikasi berbasis web yang digunakan untuk membantu proses pengelolaan dan pencatatan kehadiran guru serta siswa secara digital.

Aplikasi ini dibangun menggunakan bahasa pemrograman PHP dengan framework Laravel dan database MySQL. Sistem dapat diakses melalui browser pada komputer maupun HP yang terhubung ke jaringan Wi-Fi yang sama.

---

## 1. FITUR YANG TERSEDIA

### A. Fitur Administrator / Operator
- Mengelola data pengguna.
- Mengelola data guru dan siswa.
- Mengelola data kelas.
- Mengelola mata pelajaran.
- Mengatur dan memperbarui data yang diperlukan dalam sistem.
- Melihat dan mengelola data absensi.
- Melakukan pencatatan absensi siswa secara manual.
- Melihat laporan kehadiran guru dan siswa.
- Mengunduh laporan absensi dalam format Excel.

### B. Fitur Guru
- Melakukan absensi kehadiran guru.
- Melakukan absensi pulang guru.
- Membuat sesi absensi siswa berdasarkan kelas dan mata pelajaran.
- Membagikan kode absensi kepada siswa.
- Menutup sesi absensi.
- Melakukan pencatatan absensi siswa secara manual.
- Melihat data dan riwayat kehadiran siswa.

### C. Fitur Siswa
- Melihat informasi akun dan kelas.
- Memasukkan kode absensi yang diberikan oleh guru.
- Mengisi status kehadiran: Hadir, Izin, atau Sakit.
- Mengunggah foto bukti keterangan sakit apabila memilih status sakit.
- Melihat riwayat absensi pribadi.

---

## 2. PETUNJUK PENGGUNAAN WEB

### A. Mengakses Aplikasi
1. Pastikan komputer server dan perangkat pengguna terhubung ke jaringan Wi-Fi yang sama.
2. Pastikan aplikasi Laravel sudah dijalankan pada komputer server.
3. Buka browser pada HP atau komputer.
4. Masukkan alamat akses aplikasi yang telah diinformasikan oleh operator.
5. Setelah halaman login muncul, masukkan username dan password sesuai akun masing-masing.

### B. Login ke Sistem
1. Buka halaman login aplikasi.
2. Masukkan username.
3. Masukkan password.
4. Klik tombol **Masuk**.
5. Sistem akan menampilkan halaman dashboard sesuai hak akses pengguna.

### C. Penggunaan oleh Guru
1. Login menggunakan akun guru.
2. Pilih menu absensi guru untuk mencatat kehadiran.
3. Untuk melakukan absensi siswa, buka menu absensi siswa.
4. Pilih kelas dan mata pelajaran.
5. Buat sesi absensi.
6. Bagikan kode absensi kepada siswa.
7. Siswa memasukkan kode tersebut melalui akun masing-masing.
8. Guru dapat memantau kehadiran siswa dan menutup sesi absensi.

### D. Penggunaan oleh Siswa
1. Login menggunakan akun siswa.
2. Pilih menu absensi siswa.
3. Masukkan kode absensi yang diberikan oleh guru.
4. Pilih status kehadiran.
5. Jika memilih status sakit, unggah foto bukti keterangan sakit.
6. Klik tombol **Kirim Absensi**.
7. Periksa riwayat absensi untuk melihat catatan kehadiran.

### E. Melihat dan Mengunduh Laporan
1. Login menggunakan akun administrator/operator.
2. Buka menu laporan absensi.
3. Pilih atau sesuaikan data laporan yang ingin dilihat.
4. Periksa hasil laporan kehadiran.
5. Gunakan fitur ekspor untuk mengunduh laporan dalam format Excel.

---

## 3. PETUNJUK KHUSUS OPERATOR

**PENTING: Alamat IP komputer dapat berubah setiap kali komputer dimatikan atau dinyalakan kembali. Oleh karena itu, operator wajib memeriksa alamat IP sebelum membagikan link akses aplikasi.**

### A. Memeriksa Alamat IP Komputer
Setiap kali komputer server dinyalakan, operator harus melakukan langkah berikut:

1. Nyalakan komputer server.
2. Pastikan komputer terhubung ke jaringan Wi-Fi sekolah.
3. Buka Command Prompt (CMD).
4. Ketik perintah berikut:

   ```bash
   ipconfig
   ```

5. Tekan Enter.
6. Cari bagian **Wireless LAN adapter Wi-Fi**.
7. Perhatikan bagian **IPv4 Address**.
8. Catat alamat IP yang muncul.

Contoh alamat IP:

```text
10.63.196.197
```

### B. Menjalankan Aplikasi
Setelah mendapatkan alamat IP, operator harus menjalankan aplikasi Laravel.

1. Buka folder proyek aplikasi Absensi SMAN 1 Jenamas.
2. Buka terminal pada folder proyek tersebut.
3. Jalankan perintah:

   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

4. Tunggu hingga server berhasil dijalankan.
5. Jangan menutup terminal selama aplikasi masih digunakan.

### C. Memperbarui Link Akses
Setelah mendapatkan alamat IP terbaru, operator harus memperbarui link akses aplikasi.

Format link akses:

```text
http://ALAMAT-IP-KOMPUTER:8000
```

Contoh:

```text
http://10.63.196.197:8000
```

Jika alamat IP berubah menjadi `10.63.196.200`, link akses juga harus diperbarui menjadi:

```text
http://10.63.196.200:8000
```

Operator wajib menginformasikan link terbaru kepada guru dan siswa setiap kali alamat IP berubah.

**Catatan:** Jangan menggunakan link lama apabila alamat IP komputer server sudah berubah.

---

## 4. HAL YANG PERLU DIPERHATIKAN

- Komputer server harus tetap menyala selama aplikasi digunakan.
- Terminal Laravel harus tetap berjalan.
- HP dan komputer pengguna harus terhubung ke jaringan Wi-Fi yang sama.
- Pastikan alamat IP yang digunakan merupakan IPv4 dari adapter Wi-Fi.
- Jika aplikasi tidak dapat diakses, periksa koneksi Wi-Fi, alamat IP, status server Laravel, dan pengaturan Windows Firewall.
- Jangan membagikan username dan password akun kepada orang lain.
- Setiap pengguna harus menggunakan akun sesuai hak aksesnya.

---

## 5. PENANGANAN MASALAH

| Permasalahan | Solusi |
|---|---|
| Halaman web tidak dapat dibuka | Periksa koneksi Wi-Fi dan link akses. |
| Link akses tidak dapat digunakan | Periksa kembali IPv4 melalui perintah `ipconfig`. |
| Aplikasi tidak merespons | Pastikan server Laravel masih berjalan. |
| HP tidak dapat mengakses aplikasi | Pastikan HP dan komputer terhubung ke jaringan yang sama serta tidak ada pembatasan koneksi antarperangkat. |
| Halaman login tidak muncul | Periksa server Laravel dan koneksi database. |

---

## 6. INFORMASI APLIKASI

**Nama Aplikasi:** Absensi Digital SMAN 1 Jenamas  
**Jenis Aplikasi:** Sistem Informasi Berbasis Web  
**Framework:** Laravel  
**Bahasa Pemrograman:** PHP  
**Database:** MySQL  
**Akses:** Jaringan Wi-Fi lokal sekolah  
**Format Laporan:** Excel  

---

**ABSENSI DIGITAL SMAN 1 JENAMAS**

Mempermudah pengelolaan kehadiran guru dan siswa secara digital, terstruktur, dan efisien.
