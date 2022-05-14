<?php

include_once "includes/start.php";
include_once "includes/functions.php";

session_start();

if ( ! isset($_SESSION['id'])) {
    Header("Location: index.php", true, 302);
    exit;
}

if ( ! isset($_POST['body'])) {
    Header("Location: index.php?err=3", true, 302);
    exit;
}

$body = trim($_POST['body']);

if ($body === '') {
    Header("Location: index.php?err=3", true, 302);
    exit;
}

$dbh    = getDbConnection();
$sth    = $dbh->prepare("INSERT INTO posts (user_id, body, `date`) values (:user_id, :body, :date)");
$result = $sth->execute([
    'user_id' => $_SESSION['id'], 'body' => $body, 'date' => date('Y-m-d H:i:s'),
]);

if ($result === false) {
    Header("Location: index.php?err=4", true, 302);
    exit;
}

Header("Location: index.php?success=2", true, 302);
