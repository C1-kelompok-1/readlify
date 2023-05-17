<?php
require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        query("DELETE FROM pengguna WHERE role != 'admin' AND id = :id", [':id' => $id]);
        setAlert('success', 'Pengguna berhasil dihapus');
        redirect('daftar_pgna.php');
    } catch (Exception $error) {
        setAlert('danger', 'Gagal menghapus pengguna');
        redirect('daftar_pgna.php');
    }
}
?>
