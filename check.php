<?php

include_once "includes/start.php";
include_once "includes/functions.php";

session_start();

if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if ( ! isset($_POST['email'], $_POST['password'])) {
    Header("Location: index.php?err=1", true, 302);
    exit;
}

$dbh = getDbConnection();
$sth = $dbh->prepare("SELECT id, name FROM users WHERE email=:email and password=:password LIMIT 1");
$sth->execute([
    'email' => $_POST['email'], 'password' => $_POST['password'],
]);

$row = $sth->fetch();

if ($row === false) {
    Header("Location: index.php?err=2", true, 302);
    exit;
}

$_SESSION['id']   = $row['id'];
$_SESSION['name'] = $row['name'];
Header("Location: index.php?success=1", true, 302);
