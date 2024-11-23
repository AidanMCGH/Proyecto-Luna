    document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío normal del formulario

    // Obtener los datos del formulario
    var formData = new FormData(this);
    var emailInput = document.getElementById('email').value;

    // Expresión regular para validar el correo electrónico
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validar el correo electrónico
    if (!emailRegex.test(emailInput)) {
        document.getElementById('responseMessage').innerHTML = "Por favor, ingresa un correo electrónico válido.";
        // Limpiar el campo de email
        document.getElementById('email').value = '';
        document.getElementById('password').value = ''; // Opcional, también limpiar la contraseña
        return; // Detener el envío del formulario
    }

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/validaciones-login.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Mostrar la respuesta en el contenedor
            document.getElementById('responseMessage').innerHTML = xhr.responseText;

            // Verificar si la respuesta indica éxito
            if (xhr.responseText.includes("Inicio de sesión exitoso")) {
                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 2000);
            } else {
                // Limpiar los campos de entrada si hay un error
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
            }
        } else {
            document.getElementById('responseMessage').innerHTML = "Error en la solicitud.";
            // Limpiar los campos de entrada en caso de error
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
        }
    };
    xhr.onerror = function() {
        document.getElementById('responseMessage').innerHTML = "Error de conexión.";
        // Limpiar los campos de entrada en caso de error de conexión
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
    };
    xhr.send(formData); // Enviar los datos del formulario
});