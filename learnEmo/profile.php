<?php
session_start();

// Kullanıcı oturum açmamışsa giriş sayfasına yönlendir
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit();
}


$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kullanıcı bilgilerini çek
$user_name = $_SESSION['user_name'];
$sql = "SELECT user_name, email FROM users WHERE user_name = '$user_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Kullanıcı bilgilerini al
    $row = $result->fetch_assoc();
    $email = $row['email'];
} else {
    echo "Kullanıcı bulunamadı";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- AppBar -->
    <header class="app-bar">
        <div class="logo-section">
            <h1>LearnEmo</h1>
        </div>
        <div class="profile-section">
            <img src="images/profile.gif" alt="Profile Icon" class="profile-icon" onclick="toggleProfileModal()">
        </div>
    </header>

    <!-- Welcome Message -->
    <section class="welcome-section">
        <h2>Hoş Geldin, <?php echo $_SESSION['user_name']; ?>!</h2>
    </section>

    <!-- Content Section -->
    <main class="dashboard">
        <div class="card">
            <div class="owl"></div>
            <h3>Duygu Tanıma</h3>
            <p>Metin, ses ve video aracılığıyla duygusal farkındalık geliştirin.</p>
            <button class="action-btn">Git</button>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Duygusal Farkındalık Eğitimi</h3>
            <p>Kişiselleştirilmiş senaryolar ile farkındalık kazanın.</p>
            <button class="action-btn">Git</button>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Duygusal Zeka Testleri</h3>
            <p>Kendinizi değerlendirin ve ilerlemenizi takip edin.</p>
            <button class="action-btn">Git</button>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Mindfulness ve Stres Yönetimi</h3>
            <p>Stres yönetimi teknikleri ve meditasyon ile rahatlayın.</p>
            <button class="action-btn">Git</button>
        </div>
    </main>

    <!-- Profil Modal -->
    <div id="profileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleProfileModal()">&times;</span>
            <h2>Profil Bilgileri</h2>
            <p>Ad: <?php echo $user_name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>

    <script src="modul.js"></script>

    <script>
        // Modal açma/kapama işlevi
        function toggleProfileModal() {
            const modal = document.getElementById('profileModal');
            if (modal.style.display === "block") {
                modal.style.display = "none";
            } else {
                modal.style.display = "block";
            }
        }

        // Sayfa dışına tıklandığında modalı kapat
        window.onclick = function(event) {
            const modal = document.getElementById('profileModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
