<?php

require "koneksi.php";

$query = "SELECT
            novel.id,
            novel.judul,
            novel.photo_filename,
            novel.tanggal,
            pengguna.username AS username,
            COUNT(episode_novel.id) AS jumlah_episode,
            COUNT(episode_novel_disukai.id) AS jumlah_disukai
          FROM novel
          INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
          LEFT JOIN episode_novel ON episode_novel.id_novel = novel.id
          LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
          GROUP BY novel.id;";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Genre</title>
    <?php require 'layouts/styles.php'; ?>
  </head>

  <body class="bg-theme bg-theme1">
    <div id="wrapper">
      <?php require 'layouts/sidebar.php'; ?>
      <?php require 'layouts/navbar.php'; ?>
      <?php require 'layouts/scripts.php'; ?>

      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Novel</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Foto sampul</th>
                      <th>Judul</th>
                      <th>Penulis</th>
                      <th>Jumlah episode</th>
                      <th>Jumlah disukai</th>
                      <th>Tanggal diunggah</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while( $row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td>
                          <img src="../photos/<?php echo $row["photo_filename"]; ?>" style="width: 190px; height: 110px;" />
                        </td>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["jumlah_episode"]; ?></td>
                        <td><?php echo $row["jumlah_disukai"]; ?></td>
                        <td><?php echo $row["tanggal"]; ?></td>
                        <td class="text-right">
                          <a href="hapus_nvl.php?id=<?php echo$row['id']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash"></i>
                            Hapus
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>