<?php

    $dbh = getDbConnection();
    $sth = $dbh->prepare("SELECT users.name, posts.body, posts.`date` FROM users, posts WHERE users.id = posts.user_id and user_id=:user_id ORDER BY `date` DESC");
    $sth->execute([
        'user_id' => $_SESSION['id'],
    ]);

    $rows = $sth->fetchAll();
?>
<?php foreach ($rows as $row) {?>
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">
            <?php echo htmlentities($row['name']); ?>
            <div class='float-end fs-6 fw-normal'><small><?php echo calcula($row['date']); ?></small></div>
        </h5>
        <p class="card-text">
            <?php echo htmlentities($row['body']); ?>
        </p>
      </div>
    </div>
<?php }?>