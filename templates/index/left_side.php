<?php

$dbh = getDbConnection();
$sth = $dbh->prepare(
    "SELECT users.name from users, friends " .
    " WHERE " .
    " (users.id=friends.user1_id AND user2_id=:user_id) " .
    " OR " .
    " (users.id=friends.user2_id AND user1_id=:user_id) "
);
$sth->execute(['user_id' => $_SESSION['id']]);

$rows = $sth->fetchAll();

echo "<h5>";
echo "<img src='/avatares/" . $_SESSION['id'] . ".png' alt='' class='rounded-circle mr-4' width='32'/>";
echo $_SESSION['name'];
"</h5>";
echo "<hr/>";
echo "<p><b>Amigos</b></p>";

foreach ($rows as $row) {
    echo "<p>" . $row['name'] . "</p>";
}
