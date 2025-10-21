<?php
function loadJSON($file) {
  if (!file_exists($file)) return [];
  $data = file_get_contents($file);
  return json_decode($data, true);
}

function mergeTutorStats($tutors, $utm) {
  foreach ($tutors as &$tutor) {
    $stats = array_filter($utm, fn($u) => $u['id'] == $tutor['id']);
    $stat = reset($stats);
    $tutor['clicks'] = $stat['clicks'] ?? 0;
    $tutor['sales'] = $stat['sales'] ?? 0;
  }
  return $tutors;
}

function rankTutors($data) {
  usort($data, function($a, $b) {
    return ($b['sales'] * 100 + $b['clicks']) - ($a['sales'] * 100 + $a['clicks']);
  });
  return $data;
}

function getMedal($rank) {
  return match($rank) {
    1 => '🥇',
    2 => '🥈',
    3 => '🥉',
    default => '#' . $rank
  };
}

function findTutorStats($utmData, $id) {
  foreach ($utmData as $item) {
    if ($item['id'] == $id) return $item;
  }
  return ['clicks' => 0, 'sales' => 0];
}
