<?php
// leaderboard.php

include 'db.php';

$stmt = $pdo->query("SELECT wallet, score FROM players ORDER BY score DESC LIMIT 5");
$rows = $stmt->fetchAll();

foreach ($rows as $i => $row) {
  $rank = $i + 1;
  $wallet = substr($row['wallet'], 0, 6) . '...' . substr($row['wallet'], -4);
  echo "<p style='margin:5px 0;'>$rank. $wallet — {$row['score']} pts</p>";
}
