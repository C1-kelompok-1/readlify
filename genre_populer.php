<?php
  $genre_populer = "
  SELECT
      genre.nama,
      genre_novel.id_novel,
      genre_novel.id_genre,
      COUNT(genre_novel.id) AS jumlah_novel
  FROM genre
  LEFT JOIN genre_novel ON genre_novel.id_genre = genre.id
  LEFT JOIN novel ON novel.id = genre_novel.id_novel
  GROUP BY genre.id
  ORDER BY jumlah_novel DESC
  LIMIT 4
";

$result_genre_populer = mysqli_query($conn, $genre_populer);

?>