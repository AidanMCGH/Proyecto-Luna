
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesion</title>
    <link rel="stylesheet" href="css/style-login.css">
    
   

</head>

<body>
<div class="form-box"></div>
<form id="loginForm" method="POST">
    <h1>Iniciar Sesion</h1>
    <div class="input-box-email">
        <input type="email" id="email" name="email" placeholder="Correo Electronico">
    </div>
    <div class="input-box-password">
        <input type="password" id="password" name="password" placeholder="Contraseña">
    </div>
    <button type="submit">Ingresar</button>
    <div class="registro">
    <p>No tienes una cuenta?</p>
    <p><a href="./registro.php">Registrate</a></p>
    </div>
    <div id="responseMessage"></div>
    </form>


    <script src="js/validacion-login.js"></script>
</body>
</html>