<?php
include_once('ceasar.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ceasar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Enkripsi password menggunakan Vigenere cipher
$shift = 4;
$encrypted_password = caesar_encrypt($password, $shift );

// Lakukan penambahan data pengguna ke database
$sql = "INSERT INTO ceasar (username, password) VALUES ('$username', '$encrypted_password')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Registrasi Berhasil! </h2>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
