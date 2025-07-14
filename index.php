<?php
// index.php — Trash Tap Showdown
?>

<!DOCTYPE html>
<html>
<head>
  <title>Trash Tap Showdown</title>

  <!-- Solana Wallet Adapter (for Backpack Wallet) -->
  <script src="https://cdn.jsdelivr.net/npm/@solana/web3.js@1.41.1/lib/index.iife.min.js"></script>
</head>

<body style="font-family:sans-serif;background-color:#111;color:#fff;text-align:center;padding-top:50px;">

  <!-- Game Title -->
  <h1 style="color:#9d4edd;">🗑️ Trash Tap Showdown</h1>
  <p>Connect your Backpack wallet to start</p>

  <!-- Connect Wallet Button -->
  <button id="connectBtn" style="padding:10px 20px;background:#7209b7;color:white;border:none;border-radius:5px;font-size:16px;">
    Connect Wallet
  </button>

  <!-- Game Area (Hidden initially) -->
  <div id="gameArea" style="margin-top:30px;display:none;">
    
    <!-- Game Status -->
    <p id="status">Get ready...</p>

    <!-- Trash Tap Button -->
    <button id="trashBtn" style="display:none;font-size:22px;padding:20px 40px;border:none;background:#f72585;color:#fff;border-radius:10px;">
      🚮 TAP!
    </button>

    <!-- Result Message -->
    <p id="result" style="margin-top:20px;font-weight:bold;"></p>

    <!-- Play Again Button -->
    <button id="restartBtn" onclick="restartGame()" style="display:none;margin-top:20px;padding:10px 25px;background:#4cc9f0;color:#000;border:none;border-radius:8px;font-weight:bold;">
      🔁 Play Again
    </button>

    <!-- Leaderboard Section -->
    <h3 style="margin-top:40px;">🏆 Leaderboard</h3>
    <div id="leaderboard" style="max-width:400px;margin:0 auto;text-align:left;background:#222;padding:15px;border-radius:10px;"></div>

  </div>

  <!-- JavaScript Game Logic -->
  <script>
    let walletAddress = null;

    const connectBtn = document.getElementById('connectBtn');
    const gameArea = document.getElementById('gameArea');
    const trashBtn = document.getElementById('trashBtn');
    const status = document.getElementById('status');
    const result = document.getElementById('result');
    const restartBtn = document.getElementById('restartBtn');

    // Connect Backpack Wallet
    connectBtn.onclick = async () => {
      if (window.backpack) {
        try {
          const account = await window.backpack.connect();
          walletAddress = account.publicKey.toString();

          // Hide connect button, show game area
          connectBtn.style.display = 'none';
          gameArea.style.display = 'block';
          status.innerText = 'Wait for the trash token...';

          // Random delay before showing trash button
          setTimeout(showTrash, Math.random() * 4000 + 3000);
        } catch (err) {
          alert('Wallet connection failed.');
        }
      } else {
        alert('Backpack not installed.');
      }
    };

    // Show Trash Tap Button
    function showTrash() {
      trashBtn.style.display = 'inline-block';
      status.innerText = 'TAP NOW!';
    }

    // Handle Tap Click
    trashBtn.onclick = () => {
      trashBtn.disabled = true;
      trashBtn.style.background = '#555';
      result.innerText = 'You tapped first!';

      // Send wallet to backend for score + reward
      fetch('click.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'wallet=' + walletAddress
      })
      .then(res => res.text())
      .then(msg => {
        result.innerText = msg;

        // Show "Play Again" button
        restartBtn.style.display = 'inline-block';

        // Reload leaderboard
        loadLeaderboard();
      });
    };

    // Restart the game
    function restartGame() {
      trashBtn.disabled = false;
      trashBtn.style.background = '#f72585';
      trashBtn.style.display = 'none';
      result.innerText = '';
      status.innerText = 'Wait for the trash token...';
      restartBtn.style.display = 'none';

      // Start new round
      setTimeout(showTrash, Math.random() * 4000 + 3000);
    }

    // Load leaderboard from backend
    function loadLeaderboard() {
      fetch('leaderboard.php')
        .then(res => res.text())
        .then(html => {
          document.getElementById('leaderboard').innerHTML = html;
        });
    }

    // Load leaderboard on first load
    loadLeaderboard();
  </script>
</body>
</html>
