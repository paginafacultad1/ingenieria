<?php
$conn = mysqli_connect("localhost", "root", "Cynsam1999", "chatbot_bd");

if ($conn) {
    $user_message = mysqli_real_escape_string($conn, $_POST['messageValue']);

    // Consulta para obtener la respuesta correspondiente a la pregunta del usuario
    $query = "SELECT respuesta FROM chatbot WHERE pregunta LIKE '%$user_message%'";
    $runQuery = mysqli_query($conn, $query);

    if ($runQuery) {
        if (mysqli_num_rows($runQuery) > 0) {
            // fetch result
            $result = mysqli_fetch_assoc($runQuery);
            $bot_response = $result['respuesta'];

            // Reemplazar "[nombre]" con el nombre del usuario si está disponible
            if (strpos($bot_response, "[nombre]") !== false) {
                // Obtener el nombre proporcionado por el usuario
                $query_name = "SELECT respuesta FROM chatbot WHERE pregunta = 'nombre'";
                $runQueryName = mysqli_query($conn, $query_name);
                
                if ($runQueryName) {
                    $name_result = mysqli_fetch_assoc($runQueryName);
                    $user_name = $name_result['respuesta'];

                    // Reemplazar "[nombre]" con el nombre real del usuario
                    $bot_response = str_replace("[nombre]", $user_name, $bot_response);
                }
            }

            echo $bot_response;
        } else {
            echo "Lo lamento, no entiendo tu pregunta.";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }
} else {
    echo "conexion fallida" . mysqli_connect_errno();
}
?>
