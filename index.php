<?php
    include_once "includes/start.php";
    include_once "includes/functions.php";

    session_start();

    $is_logged = false;
    if (isset($_SESSION['id'])) {
        $is_logged = true;
    }

?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include "templates/index/messages.php";
    ?>
    <div class='container mt-4'>
        <div class='row'>
            <div class='col-3'>
                <?php
                    if ($is_logged === true) {
                        include "templates/index/left_side.php";
                    }
                ?>
            </div>
            <div class='col-6'>
                <?php
                    if ($is_logged === false) {
                        include "templates/index/form.php";
                    } else {
                        include "templates/index/post.php";
                        include "templates/index/posts.php";
                    }
                ?>
            </div>
            <div class='col-3'></div>
        </div>
    </div>
</body>
</html>
