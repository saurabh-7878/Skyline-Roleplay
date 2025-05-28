<?php
session_start();
$user = $_SESSION['discord_user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Skyline Roleplay</title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>
  <style>
    /* Set the default font for the whole site */
body {
  font-family: 'Poppins', sans-serif;
}
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap');

.logo {
  font-family: 'Orbitron', sans-serif;
  font-weight: 600;
  font-size: 1.8rem;
  color: #00ffe1;
  text-decoration: none;
  position: relative;
  display: inline-block;
  padding: 20px;
  cursor: pointer;
  animation: flicker 3s infinite;
  background: linear-gradient(90deg, #00ffe1, #00aaff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.logo::before,
.logo::after {
  content:"#SLRP";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  overflow: hidden;
  color: #ff00c8;
  z-index: -1;
  -webkit-text-fill-color: initial;
}

.logo::before {
  animation: glitchTop 2s infinite linear;
}

.logo::after {
  animation: glitchBottom 2s infinite linear;
}

@keyframes glitchTop {
  0% { clip-path: inset(0 0 90% 0); transform: translate(-2px, -2px); }
  20% { clip-path: inset(0 0 80% 0); transform: translate(2px, 0); }
  40% { clip-path: inset(0 0 60% 0); transform: translate(-2px, 2px); }
  60% { clip-path: inset(0 0 40% 0); transform: translate(0, 0); }
  80% { clip-path: inset(0 0 30% 0); transform: translate(1px, -1px); }
  100% { clip-path: inset(0 0 90% 0); transform: translate(0, 2px); }
}

@keyframes glitchBottom {
  0% { clip-path: inset(90% 0 0 0); transform: translate(2px, 2px); }
  20% { clip-path: inset(80% 0 0 0); transform: translate(-2px, 0); }
  40% { clip-path: inset(60% 0 0 0); transform: translate(2px, -2px); }
  60% { clip-path: inset(40% 0 0 0); transform: translate(0, 0); }
  80% { clip-path: inset(30% 0 0 0); transform: translate(-1px, 1px); }
  100% { clip-path: inset(90% 0 0 0); transform: translate(0, -2px); }
}

@keyframes flicker {
  0%, 18%, 22%, 25%, 53%, 57%, 100% {
    opacity: 1;
  }
  20%, 24%, 55% {
    opacity: 0.4;
  }
}

  
  /* Video Background */
#bg-video {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  z-index: -1;
}
/* General Section Styling */
  
.section {
  max-width: 1000px;
  margin: 60px auto;
  padding: 40px 30px;
  background: linear-gradient(145deg, #1a1a1a, #121212);
  opacity: 0.85;
  color: #e0e0e0;
  border-radius: 16px;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.8;

}


/* Headings */
.section h2 {
  font-size: 2.5rem;
  color:rgb(237, 231, 233);
  margin-bottom: 20px;
  border-bottom: 2px solid #47f7eb;
  padding-bottom: 10px;
}

.section h3 {
  font-size: 1.6rem;
  color:rgb(252, 248, 249);
  margin-top: 30px;
}

/* Paragraphs and Lists */
.section p {
  font-size: 1.05rem;
  color: #cccccc;
  margin-bottom: 15px;
}

.section ul {
  padding-left: 20px;
  margin-bottom: 20px;
}

.section ul li {
  margin-bottom: 8px;
  color: #dddddd;
  position: relative;
}

.section ul li::before {
  content: "✔";
  color: #e91e63;
  position: absolute;
  left: -20px;
}

/* Button */
.btn-discord {
  display: inline-flex;
  align-items: center;
  gap: 12px;
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
  box-shadow: 0 0 15px rgba(88, 101, 242, 0.4);
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.btn-discord::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(120deg, rgba(88, 101, 242, 0.2), rgba(88, 101, 242, 0.4));
  transition: all 0.5s ease;
  z-index: 0;
}

.btn-discord:hover::before {
  left: 100%;
}

.btn-discord:hover {
  transform: translateY(-3px);
  box-shadow: 0 0 25px rgba(88, 101, 242, 0.6);
}

.discord-icon {
  width: 20px;
  height: 20px;
  filter: brightness(0) invert(1);
  z-index: 2;
}



/* Responsive Design */
@media (max-width: 768px) {
  .section {
    padding: 30px 20px;
  }

  .section h2 {
    font-size: 2rem;
  }

  .section h3 {
    font-size: 1.3rem;
  }

  .btn {
    width: 100%;
    text-align: center;
  }
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
  <header>
    <nav>
  <a href="index.php" class="logo">SKYLINE ROLEPLAY</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="about-us.php">About Us</a></li>
    <li><a href="#rules">Rules</a></li>
    <li><a href="https://discord.gg/gtarp" target="_blank">Discord</a></li>

    <?php if (!isset($user)): ?>
      <!-- Show Login if not logged in -->
      <li><a href="discord-login.php">Log In</a></li>
    <?php else: ?>
      <!-- Show Dashboard if logged in -->
      <li><a href="dashboard.php">Dashboard</a></li>
    <?php endif; ?>
  </ul>
</nav>
  </header>

  <!-- Video Background -->
<video autoplay muted loop playsinline id="bg-video">
  <source src="images/bg-vd1.mp4" type="video/mp4" />
  Your browser does not support the video tag.
</video>

  <section class="section">
    <h2>About Skyline RP</h2>
    <p><strong>Skyline RP</strong> is a FiveM-based Grand Theft Auto Roleplay server designed to offer an immersive, fun, and community-driven experience.</p>
    
    <h3>🌟 Our Mission</h3>
    <p>We aim to provide a realistic and entertaining roleplay environment where creativity thrives, rules are respected, and stories are shaped by the players.</p>
    
    <h3>👥 Community First</h3>
    <p>Our team values every member of our community. Whether you are a civilian, LEO, EMS, or criminal — your role matters. We promote fair gameplay and welcome both new and experienced roleplayers.</p>
    
    <h3>🔧 Server Features</h3>
    <ul>
      <li>Custom Jobs, Vehicles, and Interiors</li>
      <li>Active Staff and Realistic Economy</li>
      <li>Whitelist Opportunities and Public Access</li>
      <li>Frequent Events and Giveaways</li>
    </ul>
    
    <h3>🎮 Join the Experience</h3>
    <p>Become a part of our growing community and build your story in Skyline RP. We’re here to help you start your RP journey with guidance and support.</p>
    <a href="https://discord.gg/gtarp" class="btn-discord" target="_blank">
  <img src="https://cdn-icons-png.flaticon.com/512/2111/2111370.png" alt="Discord" class="discord-icon">
  Join Our Discord
</a>

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
      <p>Email: <a href="mailto:support@splashcityrp.com">support@splashcityrp.com</a></p>
      <p>Discord: <a href="https://discord.gg/gtarp" target="_blank">discord.gg/gtarp</a></p>
      <p>Support Ticket: <a href="#">Open a Ticket</a></p>
    </div>

  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Skyline RP. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
