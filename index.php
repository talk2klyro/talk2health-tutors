<?php 
require_once __DIR__ . '/includes/functions.php';
$tutors = loadJSON('./data/tutors.json');
$utm = loadJSON('./data/utm.json');

// Merge tutor and UTM stats
$merged = mergeTutorStats($tutors, $utm);
$ranked = rankTutors($merged);
?>
<?php include './includes/header.php'; ?>

<main class="dashboard">
  <h1>🏆 Tutor Performance Dashboard</h1>

  <div class="sort-bar">
    <button class="active" id="sort-top">Top Performers</button>
    <button id="sort-all">All Tutors</button>
  </div>

  <section id="leaderboard" class="cards-grid">
    <?php foreach ($ranked as $index => $tutor): ?>
      <div class="card" data-id="<?= $tutor['id'] ?>">
        <div class="card-rank">
          <?= $index + 1 <= 3 ? getMedal($index + 1) : '#' . ($index + 1); ?>
        </div>
        <img src="<?= $tutor['profile_pic'] ?>" alt="<?= $tutor['name'] ?>" class="avatar">
        <h2><?= $tutor['name'] ?></h2>
        <p><?= $tutor['bio'] ?></p>

        <div class="stats">
          <span>Clicks: <b><?= $tutor['clicks'] ?? 0 ?></b></span>
          <span>Sales: <b><?= $tutor['sales'] ?? 0 ?></b></span>
        </div>

        <a href="tutor.php?id=<?= $tutor['id'] ?>" class="btn">View Profile</a>
      </div>
    <?php endforeach; ?>
  </section>
</main>

<script src="assets/js/fetchUTM.js"></script>
<?php include './includes/footer.php'; ?>
