<?php
require_once("../config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        //Simpan notifikasi ke dalam session
        $_SESSION['notification'] = [<?php
        session_start();
        $notification = $_SESSION['notification'] ?? null;
        if ($notification) {
          unset($_SESSION['notification']);
        }
        if (isset($_SESSION["username"]) || isset($_SESSION["role"])) {
          $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Silakan logout terlebih dahulu!'
          ];
          header('Location: ../dashboard.php');
        }
        ?>'type' => 'primary', 'message' => 'Registrasi Berhasil!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal Registrasi: ' . mysqli_error($conn)];
    }
    header('Location: login.php');
    exit();
}

$conn->close();
?>