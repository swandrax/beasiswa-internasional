# Vigenesia REST API

Import `database/DB/vigenesia.sql` ke MySQL terlebih dahulu. Konfigurasi koneksi memakai environment variable; lihat `.env.example`. Default lokalnya adalah:

- Host: `127.0.0.1`
- Port: `3306`
- Database: `vigenesia`
- User: `root`
- Password: kosong

Jika folder project diakses melalui document root Laragon, endpoint berada di:
`http://localhost/beasiswa-internasional/core/vigenesia80/`

Untuk URL tugas `http://localhost/vigenesia80/`, pindahkan atau salin folder `core/vigenesia80` menjadi `C:/laragon/www/vigenesia80`.

Semua endpoint POST/PUT/DELETE menerima JSON atau `x-www-form-urlencoded`.

Keamanan yang diterapkan: prepared statements, password hashing, validasi email dan panjang input, batas body 1 MB, header keamanan, CORS allowlist, serta pesan error database yang tidak membocorkan detail internal.
