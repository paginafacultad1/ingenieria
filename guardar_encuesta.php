<?php
$conn = mysqli_connect("localhost", "root", "Cynsam1999", "chatbot_bd");

if ($conn) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    $query = "INSERT INTO chatbot (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Datos de encuesta guardados correctamente.";
    } else {
        echo "Error al guardar los datos de encuesta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
}
?>
