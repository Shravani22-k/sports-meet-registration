<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

function field($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : '';
}

$fullName      = field('fullName');
$email         = field('email');
$phone         = field('phone');
$age           = field('age');
$gender        = field('gender');
$ecName        = field('ecName');
$ecPhone       = field('ecPhone');
$institution   = field('institution');
$sport         = field('sport');
$participation = field('participation');
$teamName      = field('teamName');
$tshirt        = field('tshirt');

// Basic server-side validation (the form already validates on the client,
// but never trust the client alone)
if (!$fullName || !$email || !$phone || !$age || !$gender ||
    !$institution || !$sport || !$participation || !$tshirt) {
    http_response_code(400);
    die('Missing required fields. Please go back and fill in the form completely.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    die('Invalid email address.');
}

// Generate a unique bib number, checked against the database
function generateUniqueBib($conn) {
    do {
        $bib = 'SM26-' . random_int(1000, 9999);
        $stmt = $conn->prepare('SELECT id FROM registrations WHERE bib = ?');
        $stmt->bind_param('s', $bib);
        $stmt->execute();
        $exists = $stmt->get_result()->num_rows > 0;
        $stmt->close();
    } while ($exists);
    return $bib;
}

$bib = generateUniqueBib($conn);

$stmt = $conn->prepare(
    'INSERT INTO registrations
     (bib, full_name, email, phone, age, gender, ec_name, ec_phone, institution, sport, participation, team_name, tshirt)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);
$stmt->bind_param(
    'ssssissssssss',
    $bib, $fullName, $email, $phone, $age, $gender,
    $ecName, $ecPhone, $institution, $sport, $participation, $teamName, $tshirt
);

if ($stmt->execute()) {
    $id = $stmt->insert_id;
    $stmt->close();
    $conn->close();
    header('Location: success.php?id=' . $id);
    exit;
} else {
    $error = $stmt->error;
    $stmt->close();
    $conn->close();
    http_response_code(500);
    die('Error saving registration: ' . htmlspecialchars($error));
}
