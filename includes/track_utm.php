<?php
$file = __DIR__ . '/../data/utm.json';
if (!file_exists($file)) return;

$utmData = json_decode(file_get_contents($file), true);
$utm_tutor = $_GET['utm_tutor'] ?? null;

if ($utm_tutor) {
  foreach ($utmData as &$item) {
    if ($item['utm'] === $utm_tutor) {
      $item['clicks']++;
      file_put_contents($file, json_encode($utmData, JSON_PRETTY_PRINT));
      break;
    }
  }
}
