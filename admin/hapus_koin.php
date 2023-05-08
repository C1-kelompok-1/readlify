<?php
require "koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $query = "DELETE FROM paket_koin WHERE id = $id";
    $result = mysqli_query($conn,$query);

    if ($result) {
        echo "<script>
            alert ('Data berhasil dihapus');
            window.location.href = 'koin.php';
            </script>";
    } else {
        echo "<script>
            alert ('Gagal menghapus data');
            window.location.href = 'koin.php';
            </script>";
    }
}
?>
