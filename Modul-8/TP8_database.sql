CREATE DATABASE IF NOT EXISTS TP8;
USE TP8;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    level INT NOT NULL DEFAULT 2
);

-- Tabel Data Master
CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_supplier VARCHAR(20) NOT NULL UNIQUE,
    nama_supplier VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_pelanggan VARCHAR(20) NOT NULL UNIQUE,
    nama_pelanggan VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    kategori_id INT,
    supplier_id INT,
    harga_beli DECIMAL(12,2),
    harga_jual DECIMAL(12,2),
    stok INT DEFAULT 0,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi_penjualan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_transaksi VARCHAR(50) NOT NULL UNIQUE,
    tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    pelanggan_id INT,
    user_id INT,
    total DECIMAL(12,2),
    bayar DECIMAL(12,2),
    kembalian DECIMAL(12,2),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS transaksi_penjualan_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    barang_id INT,
    jumlah INT,
    harga DECIMAL(12,2),
    subtotal DECIMAL(12,2),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi_penjualan(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);

-- Insert data contoh
INSERT INTO user (username, password, nama, level) VALUES
('owner', 'owner123', 'Pemilik Toko', 1),
('kasir1', 'kasir123', 'Kasir Pertama', 2),
('kasir2', 'kasir123', 'Kasir Kedua', 2);

-- Data Supplier
INSERT INTO supplier (kode_supplier, nama_supplier, alamat, telepon, email) VALUES
('SUP001', 'PT. Sumber Makmur', 'Jl. Industri No. 123', '021-1234567', 'info@sumbermakmur.com'),
('SUP002', 'CV. Jaya Abadi', 'Jl. Raya Bogor Km. 45', '021-7654321', 'contact@jayaabadi.co.id'),
('SUP003', 'UD. Barokah', 'Jl. Pasar Baru No. 78', '021-8889999', 'barokah.toko@gmail.com');

-- Data Kategori
INSERT INTO kategori (nama_kategori) VALUES
('Elektronik'),
('Peralatan Rumah Tangga'),
('Alat Tulis Kantor'),
('Makanan & Minuman');

-- Data Pelanggan
INSERT INTO pelanggan (kode_pelanggan, nama_pelanggan, alamat, telepon, email) VALUES
('CUST001', 'Budi Santoso', 'Jl. Merdeka No. 45', '081234567890', 'budi.santoso@email.com'),
('CUST002', 'Sari Indah', 'Jl. Melati No. 12', '081298765432', 'sari.indah@email.com'),
('CUST003', 'PT. Sejahtera Mandiri', 'Jl. Sudirman No. 789', '021-5556666', 'purchase@sejahtera.com');

-- Data Barang
INSERT INTO barang (kode_barang, nama_barang, kategori_id, supplier_id, harga_beli, harga_jual, stok) VALUES
('BRG001', 'Laptop ASUS X441', 1, 1, 4500000, 5200000, 10),
('BRG002', 'Mouse Wireless', 1, 1, 75000, 95000, 25),
('BRG003', 'Panci Aluminium 24cm', 2, 2, 65000, 85000, 15),
('BRG004', 'Buku Tulis 58 Lbr', 3, 3, 3000, 4500, 100),
('BRG005', 'Pensil 2B', 3, 3, 1500, 2500, 200),
('BRG006', 'Kopi Sachet 100gr', 4, 2, 12000, 15000, 50),
('BRG007', 'Teh Celup', 4, 2, 8000, 11000, 40);

-- Data Transaksi Contoh
INSERT INTO transaksi_penjualan (no_transaksi, tanggal_transaksi, pelanggan_id, user_id, total, bayar, kembalian) VALUES
('TRX001', '2024-01-15 10:30:00', 1, 2, 5250000, 6000000, 750000),
('TRX002', '2024-01-15 14:20:00', 2, 3, 130000, 150000, 20000),
('TRX003', '2024-01-16 09:15:00', 3, 2, 785000, 1000000, 215000);

-- Detail Transaksi
INSERT INTO transaksi_penjualan_detail (transaksi_id, barang_id, jumlah, harga, subtotal) VALUES
(1, 1, 1, 5200000, 5200000),
(1, 2, 1, 95000, 95000),
(2, 4, 10, 4500, 45000),
(2, 5, 5, 2500, 12500),
(2, 6, 2, 15000, 30000),
(2, 7, 3, 11000, 33000),
(3, 2, 2, 95000, 190000),
(3, 3, 5, 85000, 425000),
(3, 6, 10, 15000, 150000),
(3, 7, 2, 11000, 22000);