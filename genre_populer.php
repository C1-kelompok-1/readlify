<?php
  $genre_populer = "SELECT
                      genre.nama,
                      COUNT(episode_novel_disukai.id) AS jumlah_disukai,
                      COUNT(novel.id) AS jumlah_novel
                    FROM genre
                    LEFT JOIN genre_novel ON genre_novel.id_genre = genre.id
                    LEFT JOIN novel ON novel.id = genre_novel.id_novel
                    LEFT JOIN episode_novel ON episode_novel.id_novel = novel.id
                    LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
                    GROUP BY genre.id
                    ORDER BY jumlah_disukai DESC;
";

$result_genre_populer = mysqli_query($conn, $genre_populer);

?>