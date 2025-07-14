# 🗑️ Trash Tap Showdown

**Trash Tap Showdown** is a lightning-fast, browser-based multiplayer reflex game built on the **Gorbagana testnet**.  
Players compete to tap the trash token first as soon as it appears — the fastest tap wins a simulated testnet reward.

---

## 🎯 Game Concept

- Wait for the trash token to appear after a short random delay.
- Be the first to tap the 🚮 token when it shows.
- Score increases + you earn a simulated Gorbagana test token.
- Leaderboard updates in real time.
- Press "Play Again" to loop forever.

Simple. Fun. Addictive. Meme-ready.

---

## ⚡ Built for Gorbagana

Gorbagana is a fast Solana-based testnet chain. This game showcases:
- Near-instant response
- Fairness with a single-validator chain
- Creative use of test tokens
- Integration with Backpack wallet

---

## 🧑‍💻 Tech Stack

| Component | Stack |
|----------|-------|
| Frontend | HTML + Inline CSS + Vanilla JS |
| Backend  | PHP + MySQL |
| Wallet   | Backpack (with fallback for testing) |
| Network  | Gorbagana Testnet (simulated token logic) |

---

## 🧪 How We Use Gorbagana

- Connects to **Backpack**, the official wallet of Gorbagana.
- Wallets are required to play (or fallback for local testing).
- Each round **logs a simulated testnet reward** in the `rewards` table.
- All logic runs under Gorbagana-compatible assumptions.

Note: Actual token transfers are not implemented (simulated as allowed by the rules).

---

## 🛠️ How to Run Locally

1. Clone this repo:
   ```bash
   git clone https://github.com/taiwokassim/trash-tap-showdown.git
   cd trash-tap-showdown
