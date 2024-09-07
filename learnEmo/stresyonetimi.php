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

<dotlottie-player src="https://lottie.host/1ef42c32-ff88-40a4-91be-ef4366df80cc/MbvizpR9wr.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>

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
            <span>
           
Mindfulness ve Stres Yönetimi</span>
            
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
          


    <script src="scripts/stresyonetimi.js"></script>


</body>
</html>
