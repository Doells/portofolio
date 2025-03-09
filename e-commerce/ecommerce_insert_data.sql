
-- Insert data into products table
INSERT INTO products (nama_produk, harga, deskripsi, stok) VALUES
('Laptop Gaming', 15000000, 'Laptop dengan spesifikasi tinggi untuk bermain game berat.', 10),
('Smartphone Android', 3500000, 'Ponsel pintar dengan kamera 64MP dan baterai tahan lama.', 25),
('Headset Bluetooth', 250000, 'Headset nirkabel dengan noise-cancelling.', 50),
('Keyboard Mechanical', 500000, 'Keyboard dengan switch biru dan backlight RGB.', 20),
('Mouse Wireless', 150000, 'Mouse nirkabel ergonomis dengan baterai tahan lama.', 35);

-- Insert data into users table
INSERT INTO users (nama, email, password) VALUES
('Irsyadulloh RBN', 'irsyad@example.com', 'password123'),
('Aulia Rahma', 'aulia@example.com', 'password456'),
('Bagus Prasetyo', 'bagus@example.com', 'password789');

-- Insert data into orders table
INSERT INTO orders (user_id, product_id, quantity, total) VALUES
(1, 1, 1, 15000000),
(2, 2, 2, 7000000),
(1, 3, 3, 750000),
(3, 4, 1, 500000),
(3, 5, 2, 300000);

-- Optional: Select all data to verify
SELECT * FROM products;
SELECT * FROM users;
SELECT * FROM orders;
