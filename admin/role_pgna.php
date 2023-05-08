<?php
require "koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $query = "UPDATE pengguna SET `role` = 'penulis' WHERE id = $id";
    $result = mysqli_query($conn,$query);

    if ($result) {
        echo "<script>
            alert ('Pengguna sudah menjadi penulis');
            window.location.href = 'daftar_pgna.php';
            </script>";
    } else {
        echo "<script>
            alert ('Gagal mengubah pengguna');
            window.location.href = 'daftar_pgna.php';
            </script>";
    }
}
?>
