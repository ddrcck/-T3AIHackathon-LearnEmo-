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
      const response = await fetch('farkındalıkegitimiapi.php', {
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

      // Like ve dislike butonlarını ekle
      addFeedbackButtons(chatbotMessage);

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

/* Like ve Dislike Butonları Ekleme */

// Her chatbot mesajına like ve dislike butonları ekleme fonksiyonu
function addFeedbackButtons(chatbotMessage) {
    const feedbackButtons = document.createElement('div');
    feedbackButtons.className = 'feedback-buttons';
    
    const likeButton = document.createElement('button');
    likeButton.className = 'like-button';
    likeButton.textContent = '👍';
    feedbackButtons.appendChild(likeButton);
    
    const dislikeButton = document.createElement('button');
    dislikeButton.className = 'dislike-button';
    dislikeButton.textContent = '👎';
    feedbackButtons.appendChild(dislikeButton);
    
    chatbotMessage.appendChild(feedbackButtons);

    // Geri bildirim işlevini ekleyin
    likeButton.addEventListener('click', () => {
        sendFeedback('like', chatbotMessage.textContent.trim());
    });

    dislikeButton.addEventListener('click', () => {
        const alternativeResponse = prompt('Bu cevabı nasıl geliştirebiliriz?');
        sendFeedback('dislike', chatbotMessage.textContent.trim(), alternativeResponse);
    });
}

// Geri bildirimi işleyen ve verileri kaydeden fonksiyon
// Geri bildirimi işleyen ve verileri kaydeden fonksiyon
function sendFeedback(rating, responseText, feedbackText = '') {
  const feedbackData = {
      interaction_id: generateInteractionId(),
      user_id: 'user_001',  // Dinamik kullanıcı ID'si kullanılabilir
      timestamp: new Date().toISOString(),
      content_generated: {
          response: responseText
      },
      user_feedback: {
          rating: rating,
          feedback_text: feedbackText,
          preferred_response: feedbackText
      },
      feedback_metadata: {
          device: getDeviceType(),
          location: 'İstanbul, Türkiye',  // Kullanıcı lokasyonu isteğe bağlıdır
          session_duration: 30  // Dinamik olarak hesaplanabilir
      }
  };

  // Veriyi sunucuya gönderme
  fetch('save_feedback.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(feedbackData)
  }).then(response => response.json())
    .then(data => console.log('Geri bildirim kaydedildi:', data))
    .catch(error => console.error('Geri bildirim kaydedilirken hata oluştu:', error));
}


// Etkileşim için rastgele bir ID oluşturan fonksiyon
function generateInteractionId() {
    return Math.random().toString(36).substr(2, 9);  // Rastgele bir ID oluşturur
}

// Kullanıcının cihazını belirleyen fonksiyon
function getDeviceType() {
    const ua = navigator.userAgent;
    if (/mobile/i.test(ua)) return 'mobile';
    if (/tablet/i.test(ua)) return 'tablet';
    return 'desktop';
}

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
