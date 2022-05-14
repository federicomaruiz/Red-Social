<?php

if (isset($_GET['err'])) {
    echo '<div class="alert alert-danger text-center" role="alert">';

    $errors = [
        1 => "Lo sentimos ha habido un error",
        2 => "Lo sentimos no tenemos a ningún usuario con esos datos",
        3 => "Por favor indique el contenido su mensaje",
        4 => "Lo sentimos no se ha podido insertar el mensaje",
    ];

    if ( ! isset($errors[$_GET['err']])) {
        echo "Lo sentimos ha habido un error";
    } else {
        echo htmlentities($errors[$_GET['err']]);
    }

    echo "</div>";
}

if (isset($_GET['success'])) {
    echo '<div class="alert alert-success text-center" role="alert">';
    switch ($_GET['success']) {
        case 1:
            echo "¡Bienvenido!";
            break;
        case 2:
            echo "Mensaje creado";
            break;
    }
    echo "</div>";
}

if (isset($_GET['success']) || isset($_GET['err'])) {
    echo "<script>";
    echo "setTimeout(function () {

        $('.alert').fadeOut(500, function () {
            $(this).remove()
        })

    }, 3000)";
    echo "</script>";
}
