<?php
session_start();
include 'conexion-bd.php'; // Incluye la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos
    if (empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT cedula, contrasena FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($cedula, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['user_cedula'] = $cedula; // Usar cédula como identificador
            $_SESSION['user_email'] = $email;

            // Redirigir a la página de inicio o dashboard
            echo "Inicio de sesión exitoso. Redirigiendo...";
            echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 2000);</script>";
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El correo electrónico no está registrado.";
    }

    $stmt->close();
} else {
    echo "Método de solicitud no válido.";
}

$conexion->close();
?>