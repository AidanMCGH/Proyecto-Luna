<?php
session_start();

function getConnection() {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "iamib";

    $conexion = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conexion->connect_error) {
        error_log("Error de Conexion: " . $conexion->connect_error);
        echo "No se pudo conectar a la base de datos";
        exit;
    }
    return $conexion;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $telefono = trim($_POST['telefono']);

    // Validar que todos los campos estén completos
    if (empty($nombre) || empty($apellido) || empty($cedula) || empty($email) || empty($password) || empty($telefono)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Validar el formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
        exit;
    }

    // Validar el formato de la cédula
    if (!preg_match("/^[0-9]{7,10}$/", $cedula)) {
        echo "La cédula debe contener entre 7 y 10 dígitos.";
        exit;
    }

    // Validar el formato del teléfono
    if (!preg_match("/^[0-9]{7,15}$/", $telefono)) {
        echo "El teléfono debe contener entre 7 y 15 dígitos.";
        exit;
    }

    // Crear una nueva conexión para verificar si el correo o la cédula ya existen
    $conexion = getConnection();
    $stmt = $conexion->prepare("SELECT COUNT(*) FROM clientes WHERE email = ? OR cedula = ?");
    $stmt->bind_param("ss", $email, $cedula);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    if ($count > 0) {
        echo "El correo electrónico o la cédula ya están registrados.";
        $stmt->close();
        $conexion->close();
        exit;
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Crear una nueva conexión para insertar el nuevo usuario
    $conexion = getConnection();
    $stmt = $conexion->prepare("INSERT INTO clientes (nombre, apellido, cedula, email, contrasena, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Enlazar los parámetros
    $stmt->bind_param("ssssss", $nombre, $apellido, $cedula, $email, $hashed_password, $telefono);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>