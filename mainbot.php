<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba jaguarbot</title>
    <link rel="stylesheet" href="css/bot.css">
    <style>
        /* Estilos generales */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #screen {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        #header {
            background-color: #3b5998;
            border-radius: 10px 10px 0 0;
            color: white;
            font-size: 24px;
            padding: 10px;
            text-align: center;
        }

        /* Estilos para los mensajes */
        .chat {
            display: flex;
            margin: 5px 0;
        }

        .botMessages p,
        .usersMessages p {
            background-color: #3b5998;
            color: white;
            padding: 10px;
            border-radius: 10px;
            max-width: 70%;
            word-wrap: break-word;
        }

        /* Estilos para los mensajes del chatbot */
        .botMessages p {
            border-radius: 0 10px 10px 10px;
            margin-right: auto;
        }

        /* Estilos para los mensajes del usuario */
        .usersMessages p {
            background-color: #ccc;
            color: black;
            border-radius: 10px 10px 10px 0;
            margin-left: auto;
        }

        /* Otros estilos */
        #userInput {
            display: flex;
            margin-top: 10px;
        }

        #messages {
            flex-grow: 1;
            padding: 5px;
            border-radius: 5px;
            border: none;
            margin-right: 5px;
        }

        #send {
            background-color: #3b5998;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #send:focus {
            outline: none;
        }

        /* Estilos para los puntos animados */
        #dot1, #dot2 {
            width: 8px;
            height: 8px;
            background-color: #3b5998;
            border-radius: 50%;
            margin: 0 3px;
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        /* Estilo para la encuesta */
        #encuesta {
            background-color: #e1f1ff;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
        }

        /* Estilo para el mensaje de bienvenida */
        .botMessages {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
        }

    </style>
</head>
<body>
<div id="container">
    <div id="dot1"></div>
    <div id="dot2"></div>
    <div id="screen">
        <div id="header">Jaguarbot</div>
        <div id="messageDisplaySection">
            <!-- Encuesta -->
            <div class="chat botMessages">
                ¡Hola! Soy Jaguarbot, tu asistente virtual. 
                Por favor, proporciona tus datos para poder ayudarte mejor.
            </div>
            <div id="encuesta" class="chat botMessages">
                <form id="encuestaForm">
                    <div>¿Cuál es tu nombre?</div>
                    <input type="text" id="nombreEncuesta" placeholder="Nombre">
                    <div>¿Cuál es tu correo electrónico?</div>
                    <input type="email" id="correoEncuesta" placeholder="Correo Electrónico">
                    <div>¿Cuál es tu número de teléfono?</div>
                    <input type="tel" id="telefonoEncuesta" placeholder="Teléfono">
                    <button type="submit" id="enviarEncuesta">Enviar</button>
                </form>
            </div>
            
            <!-- Caja de mensajes -->
            <div id="cajaMensajes" style="display: none;">
                <!-- Aquí se mostrarían los mensajes de la conversación -->
                <div id="messageDisplaySection"></div>
                <div id="userInput">
                    <input type="text" name="messages" id="messages" autocomplete="OFF" placeholder="Escribe tu mensaje aquí." required>
                    <input type="submit" value="Send" id="send" name="send">
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- jQuery Start -->
    <script>
        $(document).ready(function(){
            $("#messages").on("keyup", function() {
                if ($("#messages").val()) {
                    $("#send").css("display", "block");
                } else {
                    $("#send").css("display", "none");
                }
            });

            $("#send").on("click", function(e){
                var userMessage = $("#messages").val();
                // Agregar mensaje del usuario al historial
                appendUserMessage(userMessage);
                
                // Realizar la solicitud al bot
                $.ajax({
                    url: "bot.php",
                    type: "POST",
                    data: { messageValue: userMessage },
                    success: function(data){
                        // Agregar respuesta del bot al historial
                        appendBotMessage(data);
                    }
                });
                
                // Limpiar el campo de entrada
                $("#messages").val("");
                $("#send").css("display", "none");
            });
        });

        // Función para agregar mensaje del usuario al historial
        function appendUserMessage(message) {
            var userMessage = '<div class="chat usersMessages"><p>' + message + '</p></div>';
            $("#messageDisplaySection").append(userMessage);
        }

        // Función para agregar respuesta del bot al historial
        function appendBotMessage(message) {
            var botMessage = '<div class="chat botMessages"><p>' + message + '</p></div>';
            $("#messageDisplaySection").append(botMessage);
        }
        $(document).ready(function () {
    // ...

    // cuando se envía el formulario del usuario
    $("#user-form").on("submit", function (e) {
        e.preventDefault();

        var nombre = $("#nombre").val();
        var correo = $("#correo").val();
        var telefono = $("#telefono").val();

        // Envía los datos del formulario al servidor para guardarlos
        $.ajax({
            url: "guardar_datos.php", // ajusta la URL al archivo que guardaría los datos en la BD
            type: "POST",
            data: {
                nombre: nombre,
                correo: correo,
                telefono: telefono,
            },
            success: function () {
                // Muestra el mensaje de bienvenida con el nombre del usuario
                var welcomeMessage = `<div class="chat botMessages">
                    ¡Hola ${nombre}! Soy Jaguarbot, tu asistente virtual. ¿En qué puedo ayudarte?
                </div>`;
                $("#messageDisplaySection").append(welcomeMessage);
            },
        });

        // Limpia los campos del formulario
        $("#nombre").val("");
        $("#correo").val("");
        $("#telefono").val("");
    });

    // ...
    });
    $(document).ready(function(){
    // Cuando se envía el formulario de encuesta
    $("#encuestaForm").on("submit", function(e) {
        e.preventDefault();

        const nombre = $("#nombreEncuesta").val();
        const correo = $("#correoEncuesta").val();
        const telefono = $("#telefonoEncuesta").val();

        // Envío de datos al servidor (puedes usar Ajax aquí)
        // ...

        // Ocultar encuesta y mostrar caja de mensajes
        $("#encuesta").hide();
        $("#cajaMensajes").show();
        });
    });


    </script>
</body>
</html>
