// Esperar a que el documento se cargue completamente
document.addEventListener("DOMContentLoaded", function() {
  // Obtener referencia a los elementos del DOM
  var messageInput = document.getElementById('messageInput');
  var sendButton = document.getElementById('sendButton');
  var chatbox = document.querySelector('.chatbox');

  // Enviar el mensaje al presionar la tecla Enter
  messageInput.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
          sendMessage();
      }
  });

  // Enviar el mensaje al hacer clic en el botón de enviar
  sendButton.addEventListener('click', sendMessage);

  // Función para enviar el mensaje
  function sendMessage() {
      var message = messageInput.value.trim();
      if (message !== '') {
          addMessage('user', message);
          messageInput.value = '';
          scrollToBottom();
          // Enviar el mensaje al servidor y obtener la respuesta
          // ...
      }
  }

  // Función para agregar un mensaje a la conversación
  function addMessage(sender, message) {
      var conversation = document.createElement('div');
      conversation.classList.add('conversation');
      conversation.innerHTML = '<div class="' + sender + '-inbox inbox">' +
          '<div class="icon">' +
          '<i class="fas fa-user"></i>' +
          '</div>' +
          '<div class="msg-header">' +
          '<p>' + message + '</p>' +
          '</div>' +
          '</div>';
      var chatBody = chatbox.querySelector('.body');
      chatBody.appendChild(conversation);
  }

  // Función para desplazarse hasta el final de la conversación
  function scrollToBottom() {
      var chatBody = chatbox.querySelector('.body');
      chatBody.scrollTop = chatBody.scrollHeight;
  }
});
