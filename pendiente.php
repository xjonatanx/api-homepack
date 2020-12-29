<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Recuperación de contraseña</title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body style="background-image: url(https://yitp.cl/api-yitp/fondo/wallpaper2.jpg); background-attachment: fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center" style="height: 100vh;">
            <div class="col">
                <div class="card" style="max-width: 500px; margin: 0 auto;">
                    <form class="login-form" action="login.php" method="post">
                        <p>
                            Enviamos un correo electrónico a <b><?php echo $_GET['email'] ?></b> para ayudarlo a recuperar su cuenta.
                        </p>
                        <p>
                            Inicie sesión en su cuenta de correo electrónico y haga clic en el enlace que le enviamos para restablecer su contraseña.
                        </p>
                    </form>
                </div>
            </div>
       </div>
    </div>
</body>
</html>