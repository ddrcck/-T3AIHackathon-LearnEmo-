<?php
// Gelen JSON verisini al
$data = file_get_contents('php://input');

// Veriyi bir JSON dosyasına kaydet
if ($data) {
    $feedback = json_decode($data, true);

    // Dosya yolu (feedback.json dosyası oluşturulacak veya var olan dosya güncellenecek)
    $file_path = 'feedback.json';

    // Eğer dosya yoksa oluştur ve ilk logu ekle
    if (!file_exists($file_path)) {
        file_put_contents($file_path, json_encode([$feedback], JSON_PRETTY_PRINT));
    } else {
        // Dosya varsa mevcut içeriği oku
        $current_data = json_decode(file_get_contents($file_path), true);

        // Yeni logu mevcut verilere ekle
        $current_data[] = $feedback;

        // Güncellenen veriyi tekrar dosyaya yaz
        file_put_contents($file_path, json_encode($current_data, JSON_PRETTY_PRINT));
    }

    // Başarılı yanıt döndür
    echo json_encode(['status' => 'success', 'message' => 'Feedback saved']);
} else {
    // Hata yanıtı
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>
