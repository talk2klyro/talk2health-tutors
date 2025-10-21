// Auto-refresh leaderboard stats every 30 seconds
setInterval(async () => {
  try {
    const res = await fetch('data/utm.json');
    const data = await res.json();

    data.forEach(stat => {
      const card = document.querySelector(`.card[data-id="${stat.id}"]`);
      if (card) {
        const spans = card.querySelectorAll('.stats span b');
        spans[0].textContent = stat.clicks;
        spans[1].textContent = stat.sales;
      }
    });
  } catch (err) {
    console.error("Failed to update UTM data:", err);
  }
}, 30000);
