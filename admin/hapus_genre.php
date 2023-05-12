<?php
require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        query("DELETE FROM genre WHERE id = :id", [':id' => $id]);
        setAlert('success', 'Genre berhasil dihapus');
        redirect('genre.php');
    } catch (Exception $error) {
        setAlert('danger', 'Gagal menghapus genre');
        redirect('genre.php');
    }
}
?>
