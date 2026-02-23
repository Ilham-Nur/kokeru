# AGENTS.md — Project KOKERU

Aturan kerja untuk AI (Codex)

--------------------------------------------------------------------

1. TUJUAN

Repository ini adalah project aktif berbasis Laravel 8.

AI hanya bertugas membantu pengembangan dengan perubahan seminimal mungkin,
tanpa merusak stabilitas sistem.

AI adalah asisten developer, bukan arsitek sistem.

Stabilitas dan kompatibilitas lebih penting daripada kreativitas.

Project ini tidak menggunakan VPS deployment.
Branch main digunakan sebagai branch utama project.

--------------------------------------------------------------------

2. ENVIRONMENT PROJECT

Framework:
- Laravel 8.83.29

PHP:
- PHP 8.3.26

Testing:
- PHPUnit 9.6.x

Aturan kompatibilitas:

- Semua kode HARUS kompatibel dengan Laravel 8
- Semua kode HARUS kompatibel dengan PHP 8.3
- Jangan gunakan fitur Laravel 9/10/11/12
- Jangan gunakan fitur PHP 8.4 atau lebih tinggi
- Ikuti constraint composer: php ^7.3|^8.0
- Hindari syntax modern yang berpotensi tidak stabil di Laravel 8

--------------------------------------------------------------------

3. STRUKTUR BRANCH (WAJIB DIIKUTI)

Branch utama:
- main

Branch lain yang pernah ada:
- ilham (sudah merged ke main)
- riyan (sudah merged ke main)

Aturan kerja AI:

- DILARANG commit langsung ke main
- Selalu buat branch baru dari main

Format branch:

- feature/nama-fitur
- fix/nama-perbaikan
- refactor/nama-area

Flow kerja:

1. Buat branch dari main
2. Kerjakan perubahan di branch tersebut
3. Buat Pull Request ke main
4. Merge dilakukan manual oleh developer

--------------------------------------------------------------------

4. BATASAN PERUBAHAN

AI BOLEH mengubah:

- app/
- routes/
- resources/
- database/
- tests/

AI BOLEH:

- Menambahkan migration jika dibutuhkan
- Menambahkan test
- Refactor kecil jika aman
- Perbaikan bug
- Penambahan fitur sesuai instruksi

AI TIDAK BOLEH:

- Upgrade Laravel
- Downgrade Laravel
- Mengubah versi PHP
- Mengubah arsitektur besar project
- Mengganti struktur folder
- Mengubah file config tanpa instruksi
- Menghapus middleware
- Mengubah sistem authentication
- Menambah package berat tanpa justifikasi

Jika perlu package baru, WAJIB jelaskan:

- Alasan teknis
- Dampak ke sistem
- Alternatif tanpa package

--------------------------------------------------------------------

5. STANDAR CODING

- Ikuti struktur Laravel 8
- Controller harus tetap tipis
- Jangan taruh logic berat di Blade
- Jangan duplikasi logic
- Jangan buat pola arsitektur baru tanpa instruksi
- Ikuti pola yang sudah ada di project

Validasi:

- Gunakan FormRequest jika memang sudah digunakan
- Jika tidak, gunakan $request->validate()

Keamanan:

- Jangan melemahkan auth
- Jangan menghapus middleware
- Jangan membuka akses data sensitif
- Jangan ubah Gate/Policy tanpa instruksi

--------------------------------------------------------------------

6. ATURAN DATABASE

- Jangan ubah struktur tabel tanpa migration
- Migration WAJIB memiliki method down()
- Jangan ubah kolom existing tanpa analisa dampak
- Jangan hardcode data penting
- Gunakan seeder jika perlu data default

--------------------------------------------------------------------

7. QUALITY CHECK (WAJIB SEBELUM SELESAI)

Project ini TIDAK menggunakan Laravel Pint.

Sebelum task selesai:

1. Jalankan test:

   ./vendor/bin/phpunit

   atau

   php artisan test

2. Pastikan:

- Tidak ada dd()
- Tidak ada dump()
- Tidak ada var_dump()
- Tidak ada debug code
- Tidak ada console.log di blade
- Tidak ada unused import
- Tidak ada syntax error
- Tidak ada error PHP 8.3

3. Pastikan:

- Tidak ada breaking change
- Tidak merusak fitur existing
- Tidak mengubah behavior tanpa instruksi

--------------------------------------------------------------------

8. DEFINITION OF DONE

Task dianggap selesai jika:

- Tidak ada error
- Test lulus
- Tidak ada debug code
- Tidak ada perubahan tidak disengaja
- Tidak ada regression

Output dari AI harus menyertakan:

- Ringkasan perubahan
- File yang diubah
- Cara test
- Asumsi yang digunakan (jika ada)

--------------------------------------------------------------------

9. PRINSIP UTAMA

- Perubahan kecil lebih aman daripada perubahan besar
- Jangan sentuh file yang tidak relevan
- Jangan mengubah konfigurasi tanpa instruksi
- Jika ragu, pilih pendekatan paling konservatif
- Stabilitas lebih penting daripada refactor besar

--------------------------------------------------------------------