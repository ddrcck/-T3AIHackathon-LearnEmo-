<?php
    session_start();
    
    // Kullanıcı oturum açmamışsa giriş sayfasına yönlendir
    if(!isset($_SESSION['user_name'])){
        header('location:login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/modülstyle.css">
    <style>
        /* Modal stili */
        .modal {
            display: none; /* Varsayılan olarak gizli */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Bulanık arka plan */
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
            border-radius: 15px; /* Tüm köşeler yuvarlak */
            position: relative;
        }
        .modal-content img {
            width: 80px;
            height: 80px;
            border-radius: 50%; /* Yuvarlak profil resmi */
            display: block;
            margin: 0 auto 10px auto;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-btn {
            background-color: #ff5e5e;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #ff3838;
        }
        /* Profil ikonu header'daki */
        .profile-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- AppBar -->
    <header class="app-bar">
        <div class="logo-section">
            <h1>LearnEmo</h1>
        </div>
        <div class="profile-section">
            <img src="images/profile.gif" alt="Profile Icon" class="profile-icon" onclick="openModal()">
        </div>
    </header>

    <!-- Modal -->
    <div id="profileModal" class="modal">
        <div class="modal-content">
            <img src="images/profile.gif" alt="Profile Icon"> <!-- Profil ikonu modal içinde -->
            <span class="close" onclick="closeModal()">&times;</span>
            <h2><?php echo $_SESSION['user_name']; ?></h2>
            <p><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'E-mail adresi mevcut değil'; ?></p>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </div>

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
            <a href="duygutanımı.php" class="action-btn">Git</a>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Duygusal Farkındalık Eğitimi</h3>
            <p>Kişiselleştirilmiş senaryolar ile farkındalık kazanın.</p>
            <a href="farkındalıkegitimi.php" class="action-btn">Git</a>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Duygusal Zeka Testleri</h3>
            <p>Kendinizi değerlendirin ve ilerlemenizi takip edin.</p>
            <a href="duygusalzeka.php" class="action-btn">Git</a>
        </div>
        <div class="card">
            <div class="owl"></div>
            <h3>Mindfulness ve Stres Yönetimi</h3>
            <p>Stres yönetimi teknikleri ve meditasyon ile rahatlayın.</p>
            <a href="stresyonetimi.php" class="action-btn">Git</a>
        </div>
    </main>

    <script>
        // Modal'ı açar
        function openModal() {
            document.getElementById("profileModal").style.display = "block";
        }

        // Modal'ı kapatır
        function closeModal() {
            document.getElementById("profileModal").style.display = "none";
        }

        // Logout işlemi
        function logout() {
            window.location.href = 'logout.php';
        }

        // Modal dışına tıklanırsa kapatma
        window.onclick = function(event) {
            var modal = document.getElementById("profileModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
