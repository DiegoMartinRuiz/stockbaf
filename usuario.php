<?php
include('funciones.php');
session_start();

if (isset($_POST['login'])) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'";
    mysqli_query($conn, $query);

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)) {
        while ($rows = mysqli_fetch_assoc($result)) {
            if (!$rows) {
                header("Location: index.php");
                echo '<p class="error">Username password combination is wrong!</p>';
            } else {
                if (password_verify($password, $rows['password'])) {
                    $_SESSION['user_id'] = $rows['id'];
                    $_SESSION['name'] = $rows['username'];
                    $_SESSION['rol'] = $rows['rol'];
                    ?>
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <title>TechMovil </title>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
                            <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>
                       <link rel="shortcut icon" href="tech.ico" />
                        </head>
                        <body>
                                 <?php   mostrarMenu() ?>
                        </body>
                    </html>
                    <?php
                    echo "<h1>Bienvenido " . $_SESSION['name'] . " ha Ingresado con Exito</h1>";
                } else {
                    echo '<p class="error">Username password combination is wrong!</p>';
                    header("Location: index.php");
                }
            }
        }
    }
} else {
    header("Location: index.php");
}