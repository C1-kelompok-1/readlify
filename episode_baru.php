<?php
$episode_baru = "
SELECT
    episode_novel.*,
    novel.judul,
    novel.slug,
    episode_novel.slug AS episode_slug,
    novel.photo_filename,
    episode_novel.judul AS episode,
    pengguna.avatar,
    pengguna.username,
    COUNT(episode_novel_disukai.id) AS jumlah_disukai
FROM episode_novel
INNER JOIN novel ON novel.id = episode_novel.id_novel
LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
INNER JOIN pengguna ON pengguna.id = novel.id_pengguna

GROUP BY episode_novel.id
ORDER BY episode_novel.tanggal DESC
LIMIT 6
";
$result_episode_baru = mysqli_query($conn, $episode_baru);

?>