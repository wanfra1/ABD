<?php
include '../servicios/bd.php';
include '../servicios/usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) &&
        $_POST['username'] != '' &&
        $_POST['username'] != null &&
        isset($_POST['password']) &&
        $_POST['password'] != '' &&
        $_POST['password'] != null) {
        $usuarios = new Usuarios();
        $usuario = $usuarios->obtenerUsuario($_POST['username'], md5($_POST['password']));
        if (($_POST['username'] == $usuario[1]) && (md5($_POST['password']) == $usuario[2])) {
            session_start();
            /* Set cookie to last 1 year */
            setcookie('username', $_POST['username'], time() + 60 * 60 * 24 * 365, '/login.php', 'www.promotoresana.com');
            setcookie('password', md5($_POST['password']), time() + 60 * 60 * 24 * 365, '/login.php', 'www.promotoresana.com');
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            header('Location: ventas/lista.php');
        } else {
            echo 'Credenciales incorrectos';
            echo md5($_POST['password']);
        }
    } else {
        echo 'Debes rellenar un usuario y contraseña';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixex-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Promotores Ana</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        <div class="container">
            <form id="login" method="post" action="./login.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="username" class="form-control" id="exampleInputEmail1" placeholder="Introduzca su email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Introduzca su password">
                </div>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
    </body>
</html>
