document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío normal del formulario

    // Obtener los datos del formulario
    var formData = new FormData(this);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/validaciones-register.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Mostrar la respuesta en el contenedor
            document.getElementById('responseMessage').innerHTML = xhr.responseText;

            // Limpiar el formulario si el registro fue exitoso
            if (xhr.responseText.includes("Registro exitoso")) {
                document.getElementById('registerForm').reset();
            }
        } else {
            document.getElementById('responseMessage').innerHTML = "Error en la solicitud.";
        }
    };
    xhr.onerror = function() {
        document.getElementById('responseMessage').innerHTML = "Error de conexión.";
    };
    xhr.send(formData); // Enviar los datos del formulario
});