<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel - Splash City RP</title>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>

<div class="admin-container">
  <aside class="sidebar">
    <h2 class="sidebar-title">Admin Panel</h2>
    <ul class="sidebar-menu">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Whitelist Applications</a></li>
      <li><a href="#">Users</a></li>
      <li><a href="#">Reports</a></li>
      <li><a href="#">Settings</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </aside>

  <main class="main-content">
    <header>
      <h1>Welcome, Admin</h1>
    </header>

    <section class="dashboard">
      <div class="card">
        <h3>Total Users</h3>
        <p>120</p>
      </div>
      <div class="card">
        <h3>Pending Whitelist</h3>
        <p>8</p>
      </div>
      <div class="card">
        <h3>Active Staff</h3>
        <p>5</p>
      </div>
    </section>
  </main>
</div>

</body>
</html>
