<?php 
require_once __DIR__ . '/includes/functions.php';
$tutors = loadJSON('./data/tutors.json');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$tutor = null;
foreach ($tutors as $t) {
  if ($t['id'] === $id) { $tutor = $t; break; }
}

if (!$tutor) {
  echo "<h2>Tutor not found.</h2>";
  exit;
}

$utmData = loadJSON('./data/utm.json');
$stats = findTutorStats($utmData, $id);
?>
<?php include './includes/header.php'; ?>

<main class="profile">
  <div class="profile-card">
    <img src="<?= $tutor['profile_pic'] ?>" alt="<?= $tutor['name'] ?>" class="avatar-large">
    <h1><?= $tutor['name'] ?></h1>
    <p class="bio"><?= $tutor['bio'] ?></p>

    <div class="followers">
      <span>👥 Followers: <b><?= $tutor['followers'] ?></b></span>
    </div>

    <div class="performance">
      <h3>Performance</h3>
      <p>Clicks: <b><?= $stats['clicks'] ?? 0 ?></b></p>
      <p>Sales: <b><?= $stats['sales'] ?? 0 ?></b></p>
    </div>

    <div class="social">
      <h3>Connect</h3>
      <a href="https://instagram.com/<?= ltrim($tutor['social']['instagram'], '@') ?>" target="_blank">Instagram</a>
      <a href="https://tiktok.com/<?= ltrim($tutor['social']['tiktok'], '@') ?>" target="_blank">TikTok</a>
    </div>
  </div>
</main>

<?php include './includes/footer.php'; ?>
