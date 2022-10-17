<?php
include('funciones.php');
session_start();

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "SELECT * FROM users WHERE EMAIL='$email' ";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res)) {
        echo '<p class="error">The email address is already registered!</p>';
    } else {
        $query2 = "INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES ('$username','$password_hash','$email' )";
        mysqli_query($conn, $query2);
        $resultado = "Registro Exitoso";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TechMovil</title>
        <link rel="shortcut icon" href="tech.ico" />
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #ffffff;
                color: #1c1e21;
            }

            main {
                height: 90vh;
                width: 100vw;
                position: inherit;
                margin: 0 auto;
            }

            

            .row {
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 100%;
                max-width: 1000px;
                position: absolute;
                left: 50%;
                top: 70%;
                transform: translate(-50%, -50%);
            }

            

            .colm-form {
                flex: 0 0 40%;
                text-align: center;
            }

            .colm-logo img {
                max-width: 400px;
            }

            .colm-logo h2 {
                font: 26px;
                font-weight: 400;
                padding: 0 30px;
                line-height: 32px;
            }

            .colm-form .form-container {
                background-color: #ffffff;
                border: none;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
                padding: 20px;
                max-width: 400px;
            }

            .colm-form .form-container input, .colm-form .form-container .btn-login {
                width: 100%;
                margin: 5px 0;
                height: 45px;
                vertical-align: middle;
                font-size: 16px;
            }

            .colm-form .form-container input {
                border: 1px solid #dddfe2;
                color: #1d2129;
                padding: 0 8px;
                outline: none;
            }

            .colm-form .form-container input:focus {
                border-color: #1877f2;
                box-shadow: 0 0 0 2px #e7f3ff;
            }

            .colm-form .form-container .btn-login {
                background-color: #FF8633;
                border: none;
                border-radius: 6px;
                font-size: 20px;
                padding: 0 16px;
                color: #ffffff;
                font-weight: 700;
            }

            .colm-form .form-container a {
                display: block;
                color: #1877f2;
                font-size: 14px;
                text-decoration: none;
                padding: 10px 0 20px;
                border-bottom: 1px solid #dadde1;
            }

            .colm-form .form-container a:hover {
                text-decoration: underline;
            }

            .colm-form .form-container .btn-new {
                background-color: #42b72a;
                border: none;
                border-radius: 6px;
                font-size: 17px;
                line-height: 48px;
                padding: 0 16px;
                color: #ffffff;
                font-weight: 700;
                margin-top: 20px;
            }

            .colm-form p {
                font-size: 14px;
            }

            .colm-form p a {
                text-decoration: none;
                color: #1c1e21;
                font-weight: 600;
            }

            .colm-form p a:hover {
                text-decoration: underline;
            }

            
        </style>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <LINK REL=StyleSheet HREF="estilos.css" TYPE="text/css" MEDIA=screen>

    </head>
    <body>
              <?php   mostrarMenu() ?>
        <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
        <h1> <?php
            if (isset($resultado)) {
                echo $resultado;
            }
            ?>
            
                        <main>
                            <div class="row">
                                <div class="colm-logo">
                                    <img src="logo.png" alt="Logo">
                                    <h2>Registro de Usuario</h2>
                                </div>
                                <div class="colm-form">
                                    <div class="form-container">
                                        <form method="post" action="" name="signup-form">
                                            <div class="form-element">
                                                <label>Username</label>
                                                <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
                                            </div>
                                            <div class="form-element">
                                                <label>Email</label>
                                                <input type="email" name="email" required />
                                            </div>
                                            <div class="form-element">
                                                <label>Password</label>
                                                <input type="password" name="password" required />
                                            </div>
                                            <button type="submit" name="register" value="register">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
    </body>
</html>