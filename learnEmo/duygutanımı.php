<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="styles/duygutanımı.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
</head>
<body>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
    <dotlottie-player src="https://lottie.host/0f579c1b-4ef5-4c1d-837e-682bb1827b50/dRuEZOZ9V6.json" background="transparent" speed="1" loop autoplay></dotlottie-player>


    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <!-- Daha fazla baloncuk ekleyebilirsiniz -->
      </div>
      
    <!-- Chatbot Container --> 
    <div id="chatbot-container">
        <div id="chatbot-header">
            <span>Duygu Tanıma</span>
            
        </div>
        
        <div id="chatbot-body">
            <div id="chatbot-messages">
                <!-- Messages will be displayed here -->
            </div> 
        </div>
        <div id="chatbot-input">
            <input type="text" id="message-input" placeholder="Sorunuzu yazın...">
            <button id="send-button">Gönder</button>
        </div>
    </div>
          


    <script src="scripts/duygutanımıscript.js"></script>


</body>
</html>
