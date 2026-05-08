-- ============================================
--  hani_web.sql
--  Jalankan file ini di phpMyAdmin atau terminal MySQL
--  Perintah: mysql -u root -p < hani_web.sql
-- ============================================

CREATE DATABASE IF NOT EXISTS hani_web
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hani_web;

-- ===== TABEL USERS =====
CREATE TABLE IF NOT EXISTS users (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50)  NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role     VARCHAR(30)  NOT NULL DEFAULT 'User',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password 1234 -> bcrypt hash
INSERT INTO users (username, password, role) VALUES
('hani',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin'),
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin')
ON DUPLICATE KEY UPDATE username=username;

-- ===== TABEL LEVEL =====
CREATE TABLE IF NOT EXISTS level (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO level (nama) VALUES
('TK'), ('SD'), ('SMP'), ('SMA'), ('S1')
ON DUPLICATE KEY UPDATE nama=nama;

-- ===== TABEL STUDIES =====
CREATE TABLE IF NOT EXISTS studies (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  nama         VARCHAR(150) NOT NULL,
  idlevel      INT          NOT NULL,
  keterangan   VARCHAR(255) DEFAULT NULL,
  tahun_lulus  YEAR         DEFAULT NULL,
  foto_sekolah VARCHAR(500) DEFAULT NULL,
  FOREIGN KEY (idlevel) REFERENCES level(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data contoh riwayat pendidikan Hani
INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES
('TK Melati Indah',  1, '-',                   2007, 'https://images.unsplash.com/photo-1562564055-71e051d33c19?w=100&q=80'),
('SD Negeri 01',     2, '-',                   2013, 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=100&q=80'),
('SMP Negeri 3',     3, '-',                   2016, 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=100&q=80'),
('SMA Negeri 2',     4, 'IPA',                 2019, 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=100&q=80'),
('Universitas XYZ',  5, 'Teknik Informatika',  2023, 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=100&q=80');
