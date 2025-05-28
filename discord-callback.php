<?php
session_start();

// Check for code and state
if (!isset($_GET['code']) || !isset($_GET['state'])) {
    die("Missing code or state.");
}

// Validate state
if (!isset($_SESSION['oauth2_state']) || $_GET['state'] !== $_SESSION['oauth2_state']) {
    die("Invalid state.");
}

// Clean up state
unset($_SESSION['oauth2_state']);

// Get authorization code
$code = $_GET['code'];

// Discord OAuth credentials
$client_id = '1376955119890989247';
$client_secret = 'h_DFnFvy1m0c43Dpvi3ypXX_JL5IAiw6';
$redirect_uri = 'http://localhost/RP_Website/discord-callback.php'; // URL-encode space or use folder name like RP_Website

// STEP 1: Exchange code for access token
$token_request = curl_init('https://discord.com/api/oauth2/token');
curl_setopt($token_request, CURLOPT_POST, true);
curl_setopt($token_request, CURLOPT_POSTFIELDS, http_build_query([
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => $redirect_uri
]));
curl_setopt($token_request, CURLOPT_RETURNTRANSFER, true);
curl_setopt($token_request, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
$response = json_decode(curl_exec($token_request), true);
curl_close($token_request);

// Validate token response
if (!isset($response['access_token'])) {
    die("Failed to obtain access token.");
}

$access_token = $response['access_token'];

// STEP 2: Fetch user info from Discord
$user_request = curl_init('https://discord.com/api/users/@me');
curl_setopt($user_request, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);
curl_setopt($user_request, CURLOPT_RETURNTRANSFER, true);
$user = json_decode(curl_exec($user_request), true);
curl_close($user_request);

$_SESSION['discord_user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'discriminator' => $user['discriminator'],
    'avatar' => $user['avatar'],
    'email' => $user['email'] ?? '',
];


// Extract user info
$discord_id = $user['id'];
$username = $user['username'] . "#" . $user['discriminator'];
$email = $user['email'] ?? null;

// STEP 3: Connect to MySQL database
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'gtarp'; // Replace with your actual DB name

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// STEP 4: Check if user exists
$stmt = $conn->prepare("SELECT id FROM users WHERE discord_id = ?");
$stmt->bind_param("s", $discord_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Existing user
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;
} else {
    // New user - insert into DB
    $stmt = $conn->prepare("INSERT INTO users (username, email, discord_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $discord_id);
    $stmt->execute();
    $_SESSION['user_id'] = $stmt->insert_id;
}

$stmt->close();
$conn->close();

// Redirect to home page
header("Location: dashboard.php");
exit;
?>
