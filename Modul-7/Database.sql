-- Buat database
CREATE DATABASE penjualan_xyz;
USE penjualan_xyz;

-- Tabel transaksi
CREATE TABLE transaksi (
    id_transaksi INT PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATE NOT NULL,
    nama_pelanggan VARCHAR(100) NOT NULL,
    keterangan ENUM('Self pickup', 'Delivery Order') NOT NULL,
    total DECIMAL(15,2) NOT NULL
);

-- Insert data ke tabel transaksi
INSERT INTO transaksi (waktu_transaksi, nama_pelanggan, keterangan, total) VALUES
('2023-11-08', 'Irfan', 'Self pickup', 16000000),
('2023-11-08', 'Rina', 'Self pickup', 15000000),
('2023-11-08', 'Budi', 'Delivery Order', 3000000),
('2023-11-09', 'Siri', 'Delivery Order', 24000000),
('2023-11-09', 'Eto', 'Self pickup', 21000000),
('2023-11-09', 'Dewi', 'Self pickup', 20000000),
('2023-11-10', 'Hari', 'Self pickup', 600000),
('2023-11-10', 'Nina', 'Self pickup', 1200000),
('2023-11-11', 'Andi', 'Delivery Order', 15000000),
('2023-11-11', 'Sari', 'Self pickup', 8600000),
('2023-11-12', 'Rudi', 'Delivery Order', 12000000),
('2023-11-12', 'Maya', 'Self pickup', 10500000),
('2023-11-13', 'Tono', 'Delivery Order', 25000000),
('2023-11-13', 'Lina', 'Self pickup', 16000000),
('2023-11-14', 'Budi', 'Self pickup', 25000000);