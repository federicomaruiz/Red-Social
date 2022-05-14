<?php
    session_start();

    if (isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if (isset($_GET['err'])) {
            echo '<div class="alert alert-danger text-center" role="alert">';

            $errors = [
                1 => "Lo sentimos ha habido un error",
                2 => "Por favor introduzca un nombre correcto",
                3 => "Por favor introduzca un correo electrónico válido",
                4 => "La contraseña debe tener un mínimo de 8 caracteres",
                5 => "Ya existe un usuario en la base de datos con ese correo",
                6 => "Lo sentimos, no hemos podido registrarle en nuestra red social",
                7 => "El avatar indicado no es correcto",
                8 => "El tipo de imagen para el avatar no es correcto",
            ];

            if ( ! isset($errors[$_GET['err']])) {
                echo "Lo sentimos ha habido un error";
            } else {
                echo htmlentities($errors[$_GET['err']]);
            }

            echo "</div>";
        }
    ?>
    <div class='container mt-4'>
        <div class='row'>
            <div class='col-3'>
            </div>
            <div class='col-6'>
                <h1 class='h4 text-center mb-4'>Por favor introduce tus datos para darte de alta</h1>
                <form method='POST' action='validate.php' enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type='text' name='name' placeholder='Nombre' required='required' class='form-control form-control-lg'/>
                    </div>
                    <div class="mb-3">
                        <input type='email' name='email' placeholder='Correo electrónico' required='required' class='form-control form-control-lg'/>
                    </div>
                    <div class="mb-3">
                        <input type='password' name='password' placeholder='Contraseña' minlength='8' required='required' class='form-control form-control-lg'/>
                    </div>
                    <div class="mb-3">
                        <label for='avatar'>Avatar (png)</label>
                        <input type='file' name='avatar' required='required' class='form-control form-control-lg'/>
                    </div>
                    <div class='d-grid'>
                        <input type='submit' value='REGISTRAR' class='btn btn-primary btn-lg'/>
                    </div>
                </form>
                <hr/>
                <p class='text-center'>¿Ya eres usuario? <a href='index.php'>¡Entra con tus datos!</a></p>

            </div>
            <div class='col-3'></div>
        </div>
    </div>
</body>
</html>
