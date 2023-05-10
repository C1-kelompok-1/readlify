<?php
$novel_populer = "SELECT
										novel.*,
										IF(LENGTH(novel.judul) > 30, CONCAT(TRIM(SUBSTRING(novel.judul, 1, 30)), '...'), novel.judul) AS judul,
										pengguna.username,
										pengguna.avatar,
										novel.photo_filename,
										IF(LENGTH(novel.deskripsi) > 100, CONCAT(TRIM(SUBSTRING(novel.deskripsi, 1, 100)), '...'), novel.deskripsi) AS deskripsi,
										COUNT(episode_novel_disukai.id) AS jumlah_disukai
									FROM novel
									LEFT JOIN episode_novel ON episode_novel.id_novel = novel.id
									LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
									INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
									GROUP BY novel.id
									ORDER BY jumlah_disukai DESC
									LIMIT 3
";

$result_novel_populer = mysqli_query($conn, $novel_populer);

?>
