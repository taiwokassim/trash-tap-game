<?php
// click.php — handles tap result, updates player score, and logs token reward

include 'db.php';

// Get the wallet address from POST request
$wallet = $_POST['wallet'] ?? '';

// Validate input
if (!$wallet) {
    echo "❌ Invalid wallet";
    exit;
}

// 1. Add or update player score
// If the player exists, increase score by 1 — otherwise insert new row
$stmt = $pdo->prepare("
    INSERT INTO players(wallet, score) 
    VALUES (?, 1) 
    ON DUPLICATE KEY UPDATE score = score + 1
");
$stmt->execute([$wallet]);

// 2. Simulate Gorbagana token reward
// Log the reward event in a rewards table
$reason = "Won Trash Tap round";
$stmt2 = $pdo->prepare("
    INSERT INTO rewards(wallet, amount, reason) 
    VALUES (?, 1, ?)
");
$stmt2->execute([$wallet, $reason]);

// 3. Send success message back to the frontend
echo "✅ You earned +1 test token for winning!";
