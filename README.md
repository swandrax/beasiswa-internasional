# Beasiswa Internasional API

Sistem manajemen beasiswa berskala internasional dengan fitur RESTful API, Role-Based Access Control (RBAC), autentikasi yang aman, serta kapabilitas real-time menggunakan arsitektur Modern MVC.

---

## 🏗️ Metode & Arsitektur (Architecture)

Proyek ini menggunakan beberapa metode dan arsitektur pengembangan modern untuk menjaga stabilitas dan skalabilitas:

### 1. MVC (Model-View-Controller)
Arsitektur ini memisahkan antara logika bisnis (Controller), manipulasi data (Model), dan presentasi (View/JSON Response). 
- **Model**: Menangani definisi skema dan relasi basis data (`User`, `Scholarship`).
- **Controller**: Memproses *request* dari *client*, menjalankan validasi, dan memanggil *model* (`AuthController`, `ScholarshipController`).
- **View**: Di dalam API, *view* digantikan oleh format respons JSON standar.

### 2. Role-Based Access Control (RBAC)
Keamanan hierarki sistem menggunakan pendekatan RBAC. Pengguna dibagi menjadi dua tipe:
- `Admin`: Memiliki hak penuh (*Create, Update, Delete*) pada data beasiswa.
- `User`: Hanya memiliki hak akses membaca (*Read*) data beasiswa.
Implementasinya diterapkan di tingkat *Middleware* (`RoleMiddleware.php`) untuk mencegat *request* sebelum sampai ke proses bisnis.

### 3. RESTful API Design
Seluruh rute (*routes*) mengikuti prinsip REST:
- Menggunakan HTTP Methods yang semantik (`GET`, `POST`, `PUT`, `DELETE`).
- Menggunakan format JSON (*Stateless*) dengan token otorisasi Bearer.
- Kode status HTTP yang sesuai (contoh: `200 OK`, `201 Created`, `204 No Content`, `403 Forbidden`).

---

## 🚀 Implementasi Fitur Utama

### 1. Autentikasi API (Laravel Sanctum)
Sistem tidak menggunakan penyimpanan *session-based* (*cookie*). Implementasi *login* menghasilkan `Personal Access Token` yang valid dan dikembalikan kepada *client* sebagai parameter otorisasi di *header* HTTP.

### 2. Real-Time Database (WebSockets - Laravel Reverb)
Setiap mutasi basis data (*Create, Update, Delete*) pada tabel beasiswa akan menerbitkan (memancarkan) kejadian / *Event* ke *message broker*.
- **Metode**: *Event Broadcasting* (Pub/Sub Pattern).
- **Proses**: `ScholarshipController` mengeksekusi *command* ke basis data -> `ScholarshipUpdated` event ditembakkan -> *Laravel Reverb* mendistribusikan *payload* JSON tersebut ke seluruh pendengar di kanal (Channel) `scholarships`.

### 3. Asynchronous Pattern (Webhook & Polling)
Proyek ini mengadopsi mekanisme *Push* dan *Pull* untuk mendistribusikan informasi kepada layanan eksternal.
- **Webhook**: Sistem menunggu *HTTP Payload* masuk dan mendaftarkannya, tanpa memblokir antarmuka (*event-driven*).
- **Polling**: Endpoint statis untuk menarik data berkala menggunakan stempel waktu (*Timestamp based fetch*).

---

## 🧮 Algoritma & Optimasi Kompleksitas (Big O)

Optimasi merupakan hal penting di saat ukuran data bertambah (Data Skala Besar / *Big Data*). Berikut adalah pendekatan algoritma yang diterapkan:

### 1. SSR Pagination (O(1) Data Retrieval vs O(N))
- **Masalah**: Pengambilan data massal seperti `Scholarship::all()` memiliki kompleksitas memori **O(N)**. Saat N = 1.000.000, *server* akan *crash*.
- **Solusi**: Menggunakan `Scholarship::paginate(10)`. Di tingkat SQL, ia diuraikan menjadi kueri `LIMIT` dan `OFFSET`. Kompleksitas pemrosesan data (waktu komputasi PHP) direduksi menjadi **O(1)** karena selalu konstan (menampilkan maksimal 10 baris pada waktu tertentu).

### 2. Solusi Kueri N+1 & Lazy Loading
- **Masalah**: Saat menampilkan 10 data beasiswa dan mengambil relasi (*contoh: entitas pembuat*), *Lazy Loading* memicu **O(N+1)** *Database Queries*. (1 kueri utama + 10 kueri tambahan = 11 kueri).
- **Solusi Algoritma**: *Eager Loading* menggunakan `with()`. Ia menggabungkan kueri menggunakan klausul `IN ()`. Kompleksitas turun menjadi **O(1)** (selalu 2 kueri, berapapun jumlah barisnya).
- **Pencegahan (Strict Mode)**: Fitur `Model::preventLazyLoading(! app()->isProduction())` diaktifkan di lapisan `AppServiceProvider` untuk memaksa program menghasilkan *Error* (*Exception*) ketimbang menyebabkan *N+1 Queries*.

---

## 💻 Panduan Instalasi dan Menjalankan Proyek

1. **Clone repositori ini**:
   ```bash
   git clone https://github.com/swandrax/beasiswa-internasional.git
   cd beasiswa-internasional
   ```

2. **Instal seluruh *dependencies***:
   ```bash
   composer install
   ```

3. **Pengaturan *Environment***:
   Salin berkas *environment* dan sesuaikan kredensial basis data Anda:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Basis Data**:
   Ini akan mengonstruksi skema di basis data Anda:
   ```bash
   php artisan migrate
   ```

5. **Jalankan *Server***:
   Anda perlu dua terminal yang berjalan paralel jika menggunakan WebSockets.
   ```bash
   # Terminal 1: Server Utama HTTP
   php artisan serve

   # Terminal 2: Server WebSockets Reverb (Untuk Real-time)
   php artisan reverb:start
   ```

6. **Pengujian Internal (Testing)**:
   Proyek ini menggunakan *PHPUnit* bawaan.
   ```bash
   php artisan test
   ```
