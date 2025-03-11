<?php
// Cara deklarasi variabel dari form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// Validasi sederhana: pastikan semua field tidak kosong
if (!empty($nama) && !empty($harga) && !empty($deskripsi)) {
    
    // Menampilkan data yang berhasil diinput
    echo "<h3>Produk Berhasil Ditambahkan!</h3>";
    echo "Nama Produk: " . $nama . "<br>";
    echo "Harga: Rp " . $harga . "<br>";
    echo "Deskripsi: " . $deskripsi . "<br><br>";


    // Simulasi query penyimpanan ke database (asumsi koneksi sudah dibuat)
    // $koneksi = mysqli_connect("localhost", "root", "", "db_toko");
    // $query = "INSERT INTO produk (nama, harga, deskripsi) VALUES ('$nama', '$harga', '$deskripsi')";
    // mysqli_query($koneksi, $query);

} else {
    // Jika ada yang kosong
    echo "<h3 style='color:red;'>Gagal Menyimpan!</h3>";
    echo "Harap isi semua data dengan lengkap.";
}
?>
