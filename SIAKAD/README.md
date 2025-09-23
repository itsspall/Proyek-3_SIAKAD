# 📘 Mission 4 – Enhancing Interactivity with DOM & JS

## 🎯 Deskripsi
Proyek ini adalah kelanjutan dari Mission 3 dengan penambahan **interaktivitas menggunakan JavaScript (DOM Manipulation & Event Handling)**.  
Studi kasus yang digunakan adalah **Sistem Akademik Sederhana** yang mendukung fitur mahasiswa dan admin.

---

## ⚙️ Fitur Utama

### 👩‍🎓 Student
- Melihat daftar mata kuliah.
- Enroll lebih dari satu mata kuliah dengan checklist.
- Perhitungan total SKS secara otomatis.
- Validasi double enroll (tidak bisa daftar mata kuliah yang sama dua kali).

### 👨‍💼 Admin
- Menambahkan mahasiswa baru dengan validasi input.
- Menambahkan mata kuliah baru dengan validasi input.
- Menghapus data dengan konfirmasi (menampilkan nama course + SKS sebelum dihapus).

### 🌐 UI & Interaksi
- Navigasi menu aktif (highlight menu yang sedang dipilih).
- Form validation (field kosong → pesan error + border merah).
- Konfirmasi sebelum delete (dialog interaktif).
- Semua interaksi berjalan **tanpa refresh halaman** (DOM based).

### 🔄 Sync & Async
- Menggunakan `setTimeout()` sebagai contoh operasi asynchronous.
- Disiapkan untuk integrasi REST API di mission berikutnya.

---

## 🛠️ Teknologi yang Digunakan
- **HTML5**
- **CSS3 (Bootstrap 5)**
- **JavaScript (ES6)**
- **Laravel Blade (untuk integrasi template)**

---

## ✅ Definition of Done (DoD)
- [x] Student dapat enroll course dengan validasi (no double enroll).
- [x] Admin dapat create student & course dengan validasi input.
- [x] UI memiliki menu aktif, form validation, dan konfirmasi delete.
- [x] Semua interaksi berbasis DOM & JS (tanpa refresh halaman).
- [x] Source code ter-upload di GitHub.
- [x] README berisi penjelasan fitur, teknologi, dan screenshot hasil uji coba.

---

## 📸 Screenshots

### Halaman Student – Enroll Course
![Student Enroll](screenshots/student-enroll.png)

### Halaman Admin – Manage Courses
![Admin Courses](screenshots/admin-courses.png)

---

## 🚀 Cara Menjalankan
1. Clone repository:
   ```bash
   git clone https://github.com/username/repo-name.git
2. Masuk ke folder project:
   ```bash
   cd repo-name
3. Jalankan Laravel:
   ```bash
   php artisan serve
1. Akses di browser:
   ```bash
   http://localhost:8000

