<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="/css/style-register.css">
</head>
<body>
<div class="form-box"></div>
<form id="registerForm" method="POST" action="./php/validaciones-register.php">
    <h1>Registro de Usuario</h1>
    <div class="input-box">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="input-box">
        <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
    </div>
    <div class="input-box">
        <input type="text" id="cedula" name="cedula" placeholder="Cédula" required>
    </div>
    <div class="input-box-email">
        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
    </div>
    <div class="input-box-password">
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
    </div>
    <div class="input-box">
        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required>
    </div>
    <button type="submit">Registrar</button>
    <div id="responseMessage"></div>
</form>
<p>Ya estas registrado? <a href="./login.php">Inicia Sesion</a></p>

<script src="js/validacion-registro.js"></script>
</body>
</html>