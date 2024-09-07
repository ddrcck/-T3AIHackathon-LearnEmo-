<?php
// API URL ve anahtar
$api_url = 'https://inference2.t3ai.org/v1/completions';
$api_key = 't3ai'; // API anahtarınızı buraya ekleyin

session_start(); // Kullanıcıya özel konuşma geçmişini saklamak için oturum başlat

// JSON verisini özel formata dönüştürme fonksiyonu
function convert_to_special_format($json_data) {
    $output = "<|begin_of_text|>";
    foreach ($json_data as $entry) {
        if ($entry["role"] == "system") {
            $output .= "<|start_header_id|>system<|end_header_id|>\n\n" . $entry["content"] . "<|eot_id|>";
        } elseif ($entry["role"] == "user") {
            $output .= "\n<|start_header_id|>user<|end_header_id|>\n\n" . $entry["content"] . "<|eot_id|>";
        } elseif ($entry["role"] == "assistant") {
            $output .= "\n<|start_header_id|>assistant<|end_header_id|>\n\n" . $entry["content"] . "<|eot_id|>";
        }
    }
    $output .= "\n<|start_header_id|>assistant<|end_header_id|>";
    return $output;
}

// API'ye gönderilecek veri
function callApi($conversation_history) {
    global $api_url, $api_key;

    // JSON verisini özel formata dönüştür
    $special_format_output = convert_to_special_format($conversation_history);

    // API'ye gönderilecek payload
    $api_data = json_encode([
        "model" => "/home/ubuntu/hackathon_model_2/",
        "prompt" => $special_format_output,
        "temperature" => 0.7, // Duygu analizi için daha yaratıcı ve samimi cevaplar
        "top_p" => 0.95,
        "max_tokens" => 512,
        "repetition_penalty" => 1.2, // Aynı ifadelerin tekrarını engellemek için
        "stop_token_ids" => [128001, 128009],
        "skip_special_tokens" => true
    ]);

    // HTTP isteği
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\nAuthorization: Bearer $api_key\r\n",
            'method'  => 'POST',
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
        return json_encode(['response' => $response['choices'][0]['text'] ?? 'API yanıtı bulunamadı.']);
    }
}

// Mesajı al ve API'yi çağır
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $user_input = $data['user_input'] ?? '';
    $child_age = $data['child_age'] ?? ''; // Kullanıcıdan çocuğun yaşını al

    // Eğer session'da konuşma geçmişi yoksa sistem mesajını içeren ilk veri ile başlat
    if (!isset($_SESSION['conversation_history'])) {
        $_SESSION['conversation_history'] = [
            ["role" => "system", "content" => "Sen çocuklar için  seneryo üreten ve  duygusal farkındalık eğitimi veren bir asistansın.Unutma çocouk nasıl hissetiğini söyledikten sonra konu ile seneryo ver. Çocuklara basit dilde kişiselleştirilmiş senaryolar sunarak duygusal farkındalıklarını artıracaksın. Her bir senaryo çocuğun yaşına ve ilgi alanlarına göre özelleştirilecektir."]
        ];
    }

    // Yeni kullanıcı mesajını ve yaş bilgisini geçmişe ekle
    $_SESSION['conversation_history'][] = ["role" => "user", "content" => "Yaş: $child_age\n" . $user_input];

    // API çağrısı yap
    $response = callApi($_SESSION['conversation_history']);
    $response_data = json_decode($response, true);

    // Chatbot yanıtını geçmişe ekle
    $_SESSION['conversation_history'][] = ["role" => "assistant", "content" => $response_data['response']];

    // Yanıtı döndür
    echo $response;
}
?>