<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/track_utm.php';

// Get tutor redirect path based on utm_tutor parameter
$tutors = loadJSON('./data/tutors.json');
$utm_tutor = $_GET['utm_tutor'] ?? null;
$redirect = 'dashboard.php'; // fallback if no match

if ($utm_tutor) {
  foreach ($tutors as $tutor) {
    if ($tutor['utm'] === $utm_tutor) {
      $redirect = 'tutor.php?id=' . $tutor['id'];
      break;
    }
  }
}

// Redirect after tracking
header("Refresh: 2; url=$redirect");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultancy Firm | Tracking...</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: #0a0f24;
      color: #00f7ff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      text-align: center;
    }
    .landing-container {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.05);
      padding: 2rem 3rem;
      border-radius: 1.5rem;
      box-shadow: 0 0 20px rgba(0,255,255,0.1);
      animation: fadeIn 0.8s ease-in-out;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(10px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="landing-container">
    <h1>Consultancy Firm</h1>
    <p>Tracking your visit... Redirecting to your tutor’s profile ⏳</p>
  </div>
</body>
</html>
