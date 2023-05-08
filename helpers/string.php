<?php

if (!function_exists('str_contains')) {
  /**
   * 
   * Mengecek apakah suatu string terdapat di string lain.
   * 
   */
  function str_contains(string $haystack, string $needle) {
    return '' === $needle || false !== strpos($haystack, $needle);
  }
}

if (!function_exists('generateRandomString')) {
  /**
   * 
   * Menghasilkan string random.
   * 
   */
  function generateRandomString(int $length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}

if (!function_exists('slugify')) {
  /**
   * 
   * Untuk membuat slug, contoh: "Ini adalah slug" menjadi "ini-adalah-slug".
   * 
   */
  function slugify(string $text, string $divider = '-') {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
}