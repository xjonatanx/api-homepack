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
                    <div class="card-header">
                        Recuperación de contraseña
                    </div>
                    <div class="card-body">
                        <form class="login-form" action="enter_email.php" method="post">
                            <h5 class="card-title">Recuperación de contraseña</h5>
                            <div class="form-group">
                                <label for="email">Ingrese su correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                <!-- form validation messages -->
                                <?php include('messages.php'); ?>
                             </div>
                            <div class="form-group" style="text-align: right;">
                                <button class="btn btn-secondary" type="submit" onClick="history.go(-1); return false;" name="reset-password">Regresar</button>
                                <button class="btn btn-primary" type="submit" name="reset-password" style="background-color: purple; border: 1px solid purple;">Enviar solicitud</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
    
        
</body>
</html>