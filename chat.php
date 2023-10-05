<?php
include "Bot.php";
$bot = new Bot;
$questions = [
    //que es covid
    "Tengo una pregunta" => "¿Cuál es tu duda?.",
    "¿A que número me puedo comunicar para informes?" => "A este número 712 283 9118 Extensión: 1180.",
    "¿Dónde estan ubicados?" => "Ixtlahuaca Jiquipilco, San Pedro, 50740 Ixtlahuaca de Rayón, Méx.",
    "¿A que hora puedo ir?" => "De un horario de 8:00 am, a las 18:00 pm.",
    //duracion

    "¿Cuánto dura su carrera de ingenieria en computación?" => "El tiempo de la carrera es de 5 años.",
 
    //info
    
    //name
    "como te llamas?" =>"Soy IngeChat y estoy para servirte",


    //saludo
    "hola" =>"Hola!, ¿Cómo puedo ayudarte?",

 
    //despedida
    "adios" =>"cuidate",
    "hasta la proxima" =>"nos vemos pronto",
    "nos vemos" =>"te estare esperando",
    "bye" =>"Good bye ♥",
    "see you" =>"see you lader ♥",
    //
    "what is your name?" =>" my name is IngeChat",

    "tu nombre es?" => "Mi nombre es " . $bot->getName(),
    "tu eres?" => "Yo soy un " . $bot->getGender()
    
];

if (isset($_GET['msg'])) {
   
    $msg = strtolower($_GET['msg']);
    $bot->hears($msg, function (Bot $botty) {
        global $msg;
        global $questions;
        if ($msg == 'hi' || $msg == "hello") {
            $botty->reply('Hola');
        } elseif ($botty->ask($msg, $questions) == "") {
            $botty->reply("Lo siento, Las preguntas deben estar relacionadas con los servicios mencionados.");
        } else {
            $botty->reply($botty->ask($msg,$questions));
        }
    });
}
