<?php
// includes/database.php
// Konfigurasi koneksi database MySQL

define('DB_HOST', 'localhost');
define('DB_NAME', 'hani_web');
define('DB_USER', 'root');       // Ganti sesuai user MySQL Anda
define('DB_PASS', '');           // Ganti sesuai password MySQL Anda
define('DB_CHAR', 'utf8mb4');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHAR,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div style="font-family:sans-serif;padding:2rem;background:#fce4ec;color:#c2185b;border-radius:8px;margin:2rem;">
        <strong>❌ Koneksi Database Gagal!</strong><br/>
        Pastikan MySQL sudah berjalan dan database <strong>hani_web</strong> sudah dibuat.<br/><br/>
        Error: ' . htmlspecialchars($e->getMessage()) . '
    </div>');
}
