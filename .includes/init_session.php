<?php
session_start();
// ambil data dari sesi
$userId = $_SESSION["user_id"];
$name = $_SESSION["name"];
$role = $_SESSION["role"];
//ambil notifikasi jika ada, kemudian hapus dari sesi
$notification =$_SESSION['notification']??null;
if($notification) {
    unset($_SESSION['notification']);
}
/*periksa apakah sesi username dan role sudah ada, jika tidak arahkan ke halaman login */
if (empty($_SESSION["username"]) || empty($_SESSION["role"])) {
    $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Silahkan Login Terlebih Dahulu!'];
    header('Location: ./auth/login.php');
    exit(); //pastikan script berhenti setelah pengalihan
}