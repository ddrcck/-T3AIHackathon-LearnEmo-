// 1. Mesaj gönderme işlevi
const sendMessage = async function() {
    const input = document.getElementById('message-input');
    const message = input.value.trim();
    if (message === '') return;
  
    // Kullanıcı mesajını göster
    const messagesContainer = document.getElementById('chatbot-messages');
    const userMessage = document.createElement('div');
    userMessage.className = 'message user-message';
    userMessage.textContent = message;
    messagesContainer.appendChild(userMessage);
  
    // API'ye istek gönder
    try {
        const response = await fetch('apistresyonetimi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ user_input: message })
        });
  
        const data = await response.json();
  
        // Chatbot yanıtını göster
        const chatbotMessage = document.createElement('div');
        chatbotMessage.className = 'message chatbot-message';
        chatbotMessage.textContent = data.response || 'Bir hata oluştu, lütfen tekrar deneyin.';
        messagesContainer.appendChild(chatbotMessage);
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // En son mesaja otomatik kaydırma
  
    } catch (error) {
        console.error('Bir hata oluştu:', error);
        const chatbotMessage = document.createElement('div');
        chatbotMessage.className = 'message chatbot-message';
        chatbotMessage.textContent = 'Bir hata oluştu, lütfen tekrar deneyin.';
        messagesContainer.appendChild(chatbotMessage);
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // En son mesaja otomatik kaydırma
    }
  
    // Girdiyi temizle
    input.value = '';
    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Mesaj gönderildiğinde kaydırmayı en sona ayarla
  };
  
  // 2. Gönder butonuna tıklama
  document.getElementById('send-button').addEventListener('click', sendMessage);
  
  // 3. Enter tuşuna basıldığında mesaj gönder
  document.getElementById('message-input').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
      sendMessage();  // Enter'a basıldığında aynı fonksiyon çağrılıyor
    }
  });
  
  // Chatbot'u kapatma işlevi
  document.getElementById('chatbot-close').addEventListener('click', function() {
    const container = document.getElementById('chatbot-container');
    container.style.display = 'none';
  });
  
  /* Baloncukları eklemek için gerekli işlevler */
  
  // Rastgele renk üreten fonksiyon
  function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
  
  // Rastgele konum üreten fonksiyon
  function getRandomPosition() {
    const x = Math.random() * 100;
    const y = Math.random() * 100;
    return { x, y };
  }
  
  // Baloncukları oluştur ve konumları ile renkleri ayarla
  function createBubbles(num) {
    const bubblesContainer = document.querySelector('.bubbles');
    for (let i = 0; i < num; i++) {
      const bubble = document.createElement('div');
      bubble.className = 'bubble';
  
      const { x, y } = getRandomPosition();
      bubble.style.left = `${x}%`;
      bubble.style.top = `${y}%`;
      bubble.style.backgroundColor = getRandomColor();
  
      bubblesContainer.appendChild(bubble);
    }
  }
  
  // Sayfa yüklendiğinde baloncukları oluştur
  window.addEventListener('load', () => {
    createBubbles(20); // 20 baloncuk oluştur
  });
  