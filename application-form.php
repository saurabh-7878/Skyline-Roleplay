<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: discord-login.php?redirect=whitelist-form.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "gtarp");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user already submitted
$user_id = $_SESSION['user_id'];
$check = $conn->prepare("SELECT * FROM whitelist_applications WHERE user_id = ?");
$check->bind_param("s", $user_id);
$check->execute();
$result = $check->get_result();

$alreadySubmitted = $result->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Roleplay</title>
    <link rel="stylesheet" href="application.css"/>
</head>
<body>
  <header>
    
    <nav>
  <a href="index.php" class="logo">SKYLINE ROLEPLAY</a>

  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="about-us.php">About Us</a></li>
    <li><a href="#rules">Rules</a></li>
    <li><a href="https://discord.gg/gtarp" target="_blank">Discord</a></li>

      <li><a href="dashboard.php">Dashboard</a></li>
    
  </ul>
</nav>

  </header>
    


<section class="whitelist-form-section">
  <h2>🚦 Apply for Whitelist</h2>
  <p>Fill out the form below to apply for whitelisted access to Skyline Roleplay. Please answer honestly and seriously.</p>

  <?php if ($alreadySubmitted): ?>
    <div class="form-message success">
      ✅ You have already submitted your whitelist application.
    </div>
  <?php else: ?>
    <form action="submit-whitelist.php" method="post" class="whitelist-form">
      <label for="fullname">Full Name (IRL)</label>
      <input type="text" id="fullname" name="fullname" required>

      <label for="discord">Discord Username (e.g. name#1234)</label>
      <input type="text" id="discord" name="discord" required>

      <label for="age">Your Age</label>
      <input type="number" id="age" name="age" min="13" required>

      <label for="charname">Character Name (In RP)</label>
      <input type="text" id="charname" name="charname" required>

      <label for="background">Character Background</label>
      <textarea id="background" name="background" rows="4" required></textarea>

      <label for="why">Why do you want to join Skyline RP?</label>
      <textarea id="why" name="why" rows="3" required></textarea>

      <label for="experience">Previous RP Experience (if any)</label>
      <textarea id="experience" name="experience" rows="3"></textarea>

      <label for="rules">Have you read the server rules?</label>
      <select id="rules" name="rules" required>
        <option value="">Select one</option>
        <option value="yes">Yes, I have read and agree</option>
        <option value="no">No</option>
      </select>

      <button type="submit">Submit Application</button>
    </form>
  <?php endif; ?>
</section>


<footer class="site-footer">
  <div class="footer-container">

       <!-- Server Info -->
    <div class="footer-column">
      <h3>Skyline Roleplay</h3>
      <p>Join the most immersive GTA V roleplay experience. 
        Dive into a world where your story matters and every decision shapes the city.</p>
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
      <p>Email: <a href="mailto:support@splashcityrp.com">support@skylinerp.com</a></p>
      <p>Discord: <a href="https://discord.gg/gtarp" target="_blank">discord.gg/gtarp</a></p>
      <p>Support Ticket: <a href="#">Open a Ticket</a></p>
    </div>

  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Skyline RP. All rights reserved.</p>
  </div>
</footer>

<div id="success-popup" class="success-popup hidden">
  <div class="popup-content">
    <div class="checkmark-circle">
      <div class="background"></div>
      <div class="checkmark"></div>
    </div>
    <h2>Success!</h2>
    <p>Your whitelist application has been submitted.</p>
  </div>
</div>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('submitted') === '1') {
      document.getElementById('success-popup').classList.add('show');

      // Optional: auto-hide after few seconds
      setTimeout(() => {
        document.getElementById('success-popup').classList.remove('show');
      }, 4000);
    }
  });
</script>


<script src="script.js"></script>

</body>
</html>
