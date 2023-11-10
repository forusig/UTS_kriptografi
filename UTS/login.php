<?php
include_once('ceasar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir login
    $username = $_POST['username'];
$password = $_POST['password'];

    // Enkripsi kata sandi yang dimasukkan oleh pengguna untuk memeriksa kecocokan
    $shift = 4;  // Shift yang digunakan harus sama dengan saat registrasi
    $encrypted_password = caesar_encrypt($password, $shift);

    // Periksa kecocokan kata sandi dengan data yang ada di database
    $db = new mysqli("localhost", "root", "", "ceasar");

    if ($db->connect_error) {
        die("Koneksi database gagal: " . $db->connect_error);
    }

    $sql = "SELECT * FROM ceasar WHERE username = '$username' AND password = '$encrypted_password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo "Selamat datang, " . $username . "!";
    } else {
        echo "Username atau password salah.";
    }

    $db->close();
}
?>
