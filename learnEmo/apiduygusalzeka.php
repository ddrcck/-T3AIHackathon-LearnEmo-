<?php
// API URL ve anahtar (API URL ve anahtarı doğru şekilde ayarlayın)
$api_url = 'https://inference2.t3ai.org/v1/completions';
$api_key = 't3ai'; // Buraya kendi API anahtarınızı ekleyin

session_start(); // Kullanıcıya özel konuşma geçmişini saklamak için oturum başlat

// API'ye gönderilecek veri
function callApi($conversation_history) {
    global $api_url, $api_key;

    // API'ye gönderilecek payload
    $api_data = json_encode([
        "model" => "/home/ubuntu/hackathon_model_2/",
        "prompt" => $conversation_history, // Tüm kullanıcı cevapları
        "temperature" => 0.01,
        "top_p" => 0.95,
        "max_tokens" => 1024,
        "repetition_penalty" => 1.1
    ]);

    // HTTP isteği
    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\nAuthorization: Bearer $api_key\r\n",
            'method' => 'POST',
            'content' => $api_data,
        ],
    ];

    // API'ye istek gönder ve sonuçları al
    $context = stream_context_create($options);
    $result = file_get_contents($api_url, false, $context);

    if ($result === FALSE) {
        return json_encode(['response' => 'Bir hata oluştu, lütfen tekrar deneyin.']);
    } else {
        $response = json_decode($result, true);

        // Yanıtı kontrol et ve dön
        if (isset($response['choices'][0]['text'])) {
            return trim($response['choices'][0]['text']);
        } else {
            return 'API yanıtı boş ya da hatalı!';
        }
    }
}

// Soruları tanımla
$questions = [
    "Bir arkadaşın üzgün olduğunu fark ettiğinde ne yaparsın?",
    "Eğer birisi sana kızgın olduğunu gösteriyorsa nasıl tepki verirsin?",
    "Bir hata yaptığında nasıl hissedersin ve nasıl bir çözüm bulursun?",
    "Başkalarının duygularını anlamakta zorlandığın bir durum yaşadın mı? Nasıl başa çıktın?",
    "Stresli olduğunda kendini nasıl sakinleştirirsin?"
];

// Mesajı al ve API'yi çağır
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $user_input = $data['user_input'] ?? '';

    // Eğer session'da konuşma geçmişi yoksa sistem mesajını içeren ilk veri ile başlat
    if (!isset($_SESSION['conversation_history'])) {
        $_SESSION['conversation_history'] = []; // Konuşma geçmişi
        $_SESSION['current_question'] = 0; // İlk soruya başlamak için index
        $_SESSION['user_answers'] = []; // Kullanıcının yanıtlarını saklayacağız
    }

    // Kullanıcı yanıtını sakla
    if ($user_input !== '') {
        $_SESSION['user_answers'][] = $user_input;
    }

    // Eğer tüm sorular sorulduysa, analiz yap
    if ($_SESSION['current_question'] >= count($questions)) {
        // Kullanıcının yanıtlarını birleştir
        $conversation_history = implode("\n", $_SESSION['user_answers']);

        // API'ye gönder ve analiz sonucu al
        $analysis_result = callApi($conversation_history);

        // Kullanıcıya analiz raporunu gönder
        echo json_encode(['response' => "Teşekkür ederim! Duygusal zekâ testini tamamladın. İşte senin analiz raporun: " . $analysis_result]);

        // Oturumu sıfırla
        session_destroy();
    } else {
        // Mevcut soruyu al
        $current_question = $_SESSION['current_question'];
        $next_question = $questions[$current_question];

        // Sıradaki soruyu kullanıcıya gönder
        echo json_encode(['response' => $next_question]);

        // Soru index'ini bir arttır
        $_SESSION['current_question']++;
    }
}
?>