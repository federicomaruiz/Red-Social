<?php

include_once "includes/start.php";
include_once "includes/functions.php";

session_start();

if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

// Comprobar si los datos son válidos

if ( ! isset($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['avatar'])) {
    Header("Location: register.php?err=1", true, 302);
    exit;
}

$name = strip_tags(trim($_POST['name']));
if ($name === '') {
    Header("Location: register.php?err=2", true, 302);
    exit;
}

$email = strip_tags(trim($_POST['email']));
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    Header("Location: register.php?err=3", true, 302);
    exit;
}

$password = trim($_POST['password']);
if (mb_strlen($password) < 8) {
    Header("Location: register.php?err=4", true, 302);
    exit;
}

if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
    Header("Location: register.php?err=7", true, 302);
    exit;
}

$data = getimagesize($_FILES['avatar']['tmp_name']);

if ($data === false) {
    Header("Location: register.php?err=7", true, 302);
    exit;
}

if ($data['mime'] !== 'image/png') {
    Header("Location: register.php?err=8", true, 302);
    exit;
}

// Comprobar si el usuario existe

$dbh = getDbConnection();
$sth = $dbh->prepare("SELECT id FROM users WHERE email=:email LIMIT 1");
$sth->execute([
    'email' => $email,
]);

$row = $sth->fetch();
if ($row !== false) {
    Header("Location: register.php?err=5", true, 302);
    exit;
}

// Insertar usuario

$sth    = $dbh->prepare("INSERT INTO users (name, email, password) values (:name, :email, :password)");
$result = $sth->execute([
    'name' => $name, 'email' => $email, 'password' => $password,
]);

if ($result === false) {
    Header("Location: register.php?err=6", true, 302);
    exit;
}

// Almacenar en sesión

$sth = $dbh->prepare("SELECT id, name FROM users WHERE email=:email LIMIT 1");
$sth->execute([
    'email' => $email,
]);

$row = $sth->fetch();
if ($row === false) {
    Header("Location: register.php?err=6", true, 302);
    exit;
}

move_uploaded_file($_FILES['avatar']['tmp_name'], "avatares/" . $row['id'] . ".png");

$_SESSION['id']   = $row['id'];
$_SESSION['name'] = $row['name'];

Header("Location: index.php?success=1", true, 302);
