# 📌 Sistem Pelaporan Kerusakan Peralatan

Sistem Pelaporan Kerusakan Peralatan adalah aplikasi berbasis **web** yang digunakan untuk mencatat, melaporkan, dan memantau kerusakan peralatan secara terstruktur dan terdokumentasi.

Aplikasi ini dibangun menggunakan **PHP (CodeIgniter 4)** dan **MySQL**, ditujukan untuk memudahkan pengguna dalam melaporkan kerusakan serta membantu admin dalam melakukan pengelolaan dan tindak lanjut laporan.

---

## 🎯 Tujuan Aplikasi

- Mempermudah proses pelaporan kerusakan peralatan
- Mengurangi pencatatan manual
- Menyediakan data laporan yang terorganisir
- Mempercepat penanganan kerusakan

---

## ✨ Fitur Utama

### 👤 User
- Login pengguna
- Membuat laporan kerusakan
- Upload foto kerusakan
- Melihat status laporan

### 🛠️ Admin
- Login admin
- Melihat semua laporan
- Mengubah status laporan (diproses / selesai)
- Mengelola data laporan

---

## 🧰 Teknologi yang Digunakan

| Teknologi | Keterangan |
|----------|-----------|
| PHP | Versi 8.x |
| Framework | CodeIgniter 4 |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, Bootstrap |
| Server | Apache / XAMPP |

---

## 📂 Struktur Folder

Sistem-Pelaporan-Kerusakan-Peralatan
│
├── app
│ ├── Controllers
│ ├── Models
│ ├── Views
│
├── public
│ ├── css
│ ├── js
│ └── uploads
│
├── database
│ ├── migrations
│ └── seeds
│
├── writable
├── .env
├── composer.json
└── README.md


---

## 🚀 Cara Instalasi & Menjalankan Aplikasi

### 1️⃣ Clone Repository
```bash
git clone https://github.com/defriansyah666/Sistem-Pelaporan-Kerusakan-Peralatan.git
cd Sistem-Pelaporan-Kerusakan-Peralatan
2️⃣ Install Dependency
composer install
3️⃣ Konfigurasi Environment
Salin file environment:

cp env .env
Edit file .env:

CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = pelaporan_kerusakan
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
4️⃣ Import Database
Buat database di phpMyAdmin

Import file .sql jika tersedia
atau

Jalankan migration:

php spark migrate
5️⃣ Jalankan Server
php spark serve
Akses di browser:

http://localhost:8080
🧪 Akun Default (Jika Ada)
Role	Username	Password
Admin	admin	admin123
User	user	user123
Silakan ubah password setelah login.

🔄 Alur Sistem
User login

User membuat laporan kerusakan

Admin melihat laporan

Admin mengubah status laporan

User melihat update status

📸 Upload Gambar
Format: JPG / PNG

Lokasi upload:

public/uploads/
🛡️ Keamanan Dasar
Validasi input

Session login

Proteksi route admin

🧩 Pengembangan Selanjutnya
Notifikasi email

Role management

Export laporan ke PDF

Dashboard statistik

API mobile

🤝 Kontribusi
Kontribusi sangat terbuka!

Langkah kontribusi:

Fork repository

Buat branch baru

Commit perubahan

Pull Request

📜 License
Proyek ini menggunakan lisensi MIT
Bebas digunakan, dimodifikasi, dan dikembangkan.

👨‍💻 Developer
Defriansyah
GitHub: https://github.com/defriansyah666

⭐ Penutup
Jika project ini membantu, jangan lupa ⭐ repository ini.
Terima kasih 🙏


---

Kalau kamu mau, aku bisa:
- 🔧 **Sesuaikan README sesuai kode asli (controller/model yang ada)**
- 🧱 Buat **komentar dokumentasi di setiap Controller & Model**
- 📊 Buat **ERD + dokumentasi database**
- 📱 Buat **README versi Play Store / mobile**

Tinggal bilang mau lanjut ke bagian mana 🚀
