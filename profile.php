<?php
session_start();
$user = $_SESSION['discord_user'] ?? null;

if (!$user) {
  header("Location: discord-login.php");
  exit();
}

$avatar_url = "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile - Splash City RP</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .profile-container {
      max-width: 600px;
      margin: 60px auto;
      padding: 40px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 16px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      color: white;
      text-align: center;
    }

    .profile-container img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      border: 3px solid #fff;
      box-shadow: 0 0 15px rgba(0,255,255,0.5);
    }

    .profile-container h2 {
      margin-top: 20px;
      font-size: 28px;
    }

    .profile-container p {
      font-size: 16px;
      color: #ccc;
      margin: 10px 0;
    }

    .btn-logout {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      border-radius: 30px;
      font-weight: bold;
      background: #ff4b5c;
      color: #fff;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn-logout:hover {
      background: #e94151;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
    <style>
        .btn-modern {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 28px;
  background: rgba(40, 40, 50, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 40px;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  text-decoration: none;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  box-shadow: 0 0 15px rgba(0, 255, 255, 0.3); /* Cyan glow */
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.btn-modern::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(120deg, rgba(0, 255, 255, 0.2), rgba(0, 255, 255, 0.4));
  transition: all 0.5s ease;
  z-index: 0;
}

.btn-modern:hover::before {
  left: 100%;
}

.btn-modern:hover {
  transform: translateY(-3px);
  box-shadow: 0 0 25px rgba(0, 255, 255, 0.6);
}

.site-footer {
  background-color: #111;
  color: #ccc;
  padding: 60px 20px 30px;
  font-family: 'Segoe UI', sans-serif;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: auto;
  gap: 40px;
}

.footer-column {
  flex: 1 1 250px;
}

.footer-column h3 {
  color: #00f0ff;
  margin-bottom: 20px;
  font-size: 1.4rem;
}

.footer-column ul {
  list-style: none;
  padding: 0;
}

.footer-column ul li {
  margin-bottom: 10px;
}

.footer-column ul li a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-column ul li a:hover {
  color: #00f0ff;
}

.footer-column p a {
  color: #ccc;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-column p a:hover {
  color: #00f0ff;
}

.footer-bottom {
  text-align: center;
  margin-top: 40px;
  border-top: 1px solid #333;
  padding-top: 20px;
  font-size: 0.9rem;
  color: #888;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: flex-start;
  }
}

</style>

  <div class="profile-container">
    <img src="<?= htmlspecialchars($avatar_url) ?>" alt="Avatar">
    <h2><?= htmlspecialchars($user['username']) . '#' . htmlspecialchars($user['discriminator']) ?></h2>
    <p>Email: <?= htmlspecialchars($user['email'] ?? 'N/A') ?></p>
    <p>User ID: <?= htmlspecialchars($user['id']) ?></p>
    <a href="logout.php" class="btn-modern">Logout</a>
  </div>
  <footer class="site-footer">
  <div class="footer-container">

    <!-- About Us -->
    <div class="footer-column">
      <h3>Splash City Roleplay</h3>
      <p>🌐 IP: <strong>play.gtarpserver.com</strong></p>
      <p>🎮 Platform: FiveM</p>
      <p>🕹️ Status: <span style="color: #00ff99;">Online</span></p>
    </div>
    
    <!-- Quick Links -->
    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about-us.php">About Us</a></li>
        <li><a href="#rules">Rules</a></li>
      </ul>
    </div>

    <!-- Contact Us -->
    <div class="footer-column">
      <h3>Contact Us</h3>
      <p>Email: <a href="mailto:support@splashcityrp.com">support@splashcityrp.com</a></p>
      <p>Discord: <a href="https://discord.gg/gtarp" target="_blank">discord.gg/gtarp</a></p>
      <p>Support Ticket: <a href="#">Open a Ticket</a></p>
    </div>

  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Splash City RP. All rights reserved.</p>
  </div>
</footer>


</body>
</html>
