<?php
require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        query("DELETE FROM novel WHERE id = :id", [':id' => $id]);
        setAlert('success', 'Novel berhasil dihapus');
        redirect('daftar_nvl.php');
    } catch (Exception $error) {
        setAlert('danger', 'Gagal menghapus novel');
        redirect('daftar_nvl.php');
    }
}
?>
