-- Buat database
CREATE DATABASE IF NOT EXISTS sistem_penjualan;
USE sistem_penjualan;

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15)
);

-- Tabel Barang
CREATE TABLE barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    harga_satuan DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL
);

-- Tabel Transaksi (Master)
CREATE TABLE transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATETIME NOT NULL,
    keterangan TEXT,
    total DECIMAL(10,2) DEFAULT 0,
    pelanggan_id INT,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

-- Tabel Transaksi Detail
CREATE TABLE transaksi_detail (
    id INT PRIMARY KEY AUTO_INCREMENT,
    transaksi_id INT,
    barang_id INT,
    qty INT NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);

-- Data pelanggan
INSERT INTO pelanggan (nama, alamat, telepon) VALUES
('Budi Santoso', 'Jl. Merdeka No. 123, Jakarta', '081234567890'),
('Siti Rahayu', 'Jl. Sudirman No. 45, Bandung', '082345678901'),
('Ahmad Wijaya', 'Jl. Gatot Subroto No. 67, Surabaya', '083456789012'),
('Dewi Lestari', 'Jl. Thamrin No. 89, Medan', '084567890123'),
('Rina Melati', 'Jl. Diponegoro No. 12, Semarang', '085678901234');

-- Data barang
INSERT INTO barang (nama, harga_satuan, stok) VALUES
('Laptop ASUS ROG', 15000000.00, 10),
('Mouse Logitech MX', 450000.00, 50),
('Keyboard Mechanical RGB', 850000.00, 25),
('Monitor 24 inch LG', 2200000.00, 15),
('Webcam HD 1080p', 550000.00, 30),
('Headphone Sony', 750000.00, 20),
('SSD 512GB Samsung', 900000.00, 40),
('RAM 16GB DDR4', 650000.00, 35),
('Printer Epson', 1200000.00, 8),
('Tablet Samsung', 3500000.00, 12);

-- Data transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, pelanggan_id, total) VALUES
('2024-11-15 10:30:00', 'Pembelian perlengkapan kantor', 1, 16750000.00),
('2024-11-14 14:20:00', 'Pembelian alat presentasi', 2, 2750000.00),
('2024-11-13 09:15:00', 'Pembelian perangkat IT', 3, 2400000.00);

-- Data transaksi_detail
INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES
(1, 1, 1, 15000000.00),
(1, 2, 2, 900000.00),
(1, 3, 1, 850000.00),
(2, 4, 1, 2200000.00),
(2, 5, 1, 550000.00),
(3, 6, 2, 1500000.00),
(3, 7, 1, 900000.00);