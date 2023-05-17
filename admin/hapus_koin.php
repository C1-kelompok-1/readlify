<?php
require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        query("DELETE FROM paket_koin WHERE id = :id", [':id' => $id]);
        setAlert('success', 'Paket koin berhasil dihapus');
        redirect('koin.php');
    } catch (Exception $error) {
        setAlert('danger', 'Gagal menghapus paket koin');
        redirect('koin.php');
    }
}
?>
