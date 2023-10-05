<?php
// Obtener la pregunta del usuario
$userMessage = $_POST['message'];

// Responder según la pregunta del usuario
$botMessage = getBotResponse($userMessage);

// Devolver la respuesta como JSON
$response = array(
    'message' => $botMessage
);
echo json_encode($response);

// Función para obtener la respuesta del chatbot
function getBotResponse($message) {
    // Mensaje de bienvenida
    if (empty($message)) {
        return '¡Hola! ¿En qué puedo ayudarte?';
    }

    // Convertir la pregunta del usuario a minúsculas para facilitar la comparación
    $lowercaseMessage = strtolower($message);

    // Preguntas y respuestas relacionadas con la escuela
    $botResponses = array(
        'hola' => '¡Hola! ¿En qué puedo ayudarte?',
        'adiós' => 'Hasta luego. ¡Que tengas un buen día!',
        'quién te hizo' => 'Fui desarrollado por Cyn y Sam',
        'quiénes son tus desarrolladores' => 'Fui desarrollado por Cyn y Sam',
        '¿A qué número me contacto?' => 'Puedes comunicarte con nosotros al número 123-456-7890.',
        '¿Dónde están ubicados?' => 'Nos encontramos en la dirección Calle Principal, Ciudad, País.',
        '¿Cuáles son los costos?' => 'Nuestros costos varían dependiendo del programa o curso. Te recomendamos visitar nuestra página web para obtener información detallada sobre los costos.',
        '¿Cuál es el horario de clases?' => 'El horario de clases varía según el programa. Puedes consultar el horario específico en nuestra página web o contactarnos para obtener más información.',
        '¿Cuáles son los requisitos de admisión?' => 'Los requisitos de admisión pueden variar según el programa y nivel educativo. Te recomendamos visitar nuestra página web o comunicarte con nosotros para obtener información detallada sobre los requisitos de admisión.',
        '¿Ofrecen programas de becas?' => 'Sí, ofrecemos programas de becas para estudiantes destacados. Puedes obtener más información sobre nuestras becas en nuestra página web o comunicándote con nosotros.',
        // Agrega más preguntas y respuestas sobre la escuela aquí
    );

    // Verificar si la pregunta está en la lista de respuestas
    foreach ($botResponses as $question => $response) {
        // Convertir la pregunta a minúsculas para comparar
        $lowercaseQuestion = strtolower($question);

        // Verificar si la pregunta coincide con el mensaje del usuario
        if (strpos($lowercaseMessage, $lowercaseQuestion) !== false) {
            return $response;
        }
    }

    return 'Lo siento, no entiendo tu pregunta.';
}
?>
