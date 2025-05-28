<?php
session_start();
$user = $_SESSION['discord_user'] ?? null;

if (!$user) {
  header("Location: discord-login.php");
  exit;
}

$avatar_url = "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png";
$username = $user['username'] . "#" . $user['discriminator'];
$email = $user['email'] ?? 'N/A';

// Get whitelist status from DB
$conn = new mysqli("localhost", "root", "", "gtarp");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$discord_id = $user['id'];
$status = "Not Applied";

$stmt = $conn->prepare("SELECT status FROM whitelist_applications WHERE user_id = ?");
$stmt->bind_param("s", $discord_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $status = ucfirst($data['status']); // capitalized for display
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Skyline Roleplay</title>
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>
  <style>
    .main-content {
      flex: 1;
      padding: 30px;
      position: relative;
      overflow-y: auto;
      z-index: 1;
    }
    .main-content::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url("images/gta.jpg");
      background-size: cover;
      background-position: center;
      opacity: 0.2;
      z-index: -1;
    }
    .status-box {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid #ccc;
      padding: 15px;
      border-radius: 10px;
    }
  </style>

  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="profile">
        <img src="<?= htmlspecialchars($avatar_url) ?>" alt="Avatar">
        <h3><?= htmlspecialchars($username) ?></h3>
      </div>
      <nav class="nav-menu">
        <a href="index.php">🏠 Home</a>
        <a href="#profile">👤 Store</a>
        <a href="application-form.php">📝 Apply For Whitelist</a>
        <a href="#settings">⚙️ Settings</a>
        <a href="logout.php" class="logout">🚪 Logout</a>
      </nav>
    </aside>

    <main class="main-content">
      <section id="profile">
        <h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
        <div class="profile-card">
          <img src="<?= htmlspecialchars($avatar_url) ?>" alt="Avatar">
          <p><strong>Discord Tag:</strong> <?= htmlspecialchars($username) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
          <p><strong>ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
        </div>
      </section>

      <section id="whitelist">
        <h2>Whitelist Status</h2>
        <div class="status-box">
          <p><strong>Status:</strong> <?= htmlspecialchars($status) ?></p>
          <?php if ($status === "Not Applied"): ?>
            <p>You have not submitted a whitelist application yet.</p>
          <?php elseif ($status === "Pending"): ?>
            <p>Your application is under review. Please wait for an update.</p>
          <?php elseif ($status === "Approved"): ?>
            <p>✅ Congratulations! You are whitelisted.</p>
          <?php elseif ($status === "Rejected"): ?>
            <p>❌ Unfortunately, your application was not accepted. You may try again later.</p>
          <?php endif; ?>
        </div>
      </section>

      <section id="settings">
        <h2>Settings</h2>
        <p>Coming soon: Update preferences, manage notifications, and more.</p>
      </section>
    </main>
  </div>
</body>
</html>
