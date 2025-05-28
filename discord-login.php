<?php
session_start();

// Discord OAuth2 credentials
$client_id = '1376955119890989247';
$redirect_uri = 'http://localhost/RP_Website/discord-callback.php';

// Optional: Handle redirect after login (e.g., return user to intended page)
$redirect_after_login = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
$_SESSION['login_redirect'] = $redirect_after_login;

// Generate a secure state token to prevent CSRF
$state = bin2hex(random_bytes(16));
$_SESSION['oauth2_state'] = $state;

// Build the Discord OAuth2 authorization URL
$params = [
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'scope'         => 'identify email',
    'state'         => $state
];

$authorize_url = "https://discord.com/api/oauth2/authorize?" . http_build_query($params);

// Redirect the user to Discord's OAuth2 authorization page
header("Location: $authorize_url");
exit;
