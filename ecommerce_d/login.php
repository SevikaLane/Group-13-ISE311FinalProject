<?php
session_start();

// ROOT_PATH'i doğru tanımla
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

// config.php dosyasını doğru şekilde dahil et
include(ROOT_PATH . 'ecommerce_d/config.php');

function sendResponse($status, $message) {
    echo json_encode(array("status" => $status, "message" => $message));
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcıyı kontrol eden sorgu
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Şifre doğrulama
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];  
            sendResponse("success", "Giriş başarılı!");
        } else {
            sendResponse("error", "Geçersiz şifre.");
        }
    } else {
        sendResponse("error", "Kullanıcı bulunamadı.");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decathlon Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StyleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="header-top">
            <a href="index.php" class="link-wrapper" style="margin: 20px 0 0 20px;">
                <img src="images/home.svg" alt="Anasayfa">
                <span>Anasayfa</span>
            </a>
            <div class="logo" style="margin-right:700px;">
                <a href="index.php">
                    <img src="images/DecLogo.png" alt="Logo">
                </a>
            </div>
        </div>
    </header>

    <div class="body-container">
        <div class="image-section"></div>

        <div class="form-section">
            <div class="form-container">
                <h1>Oturum Aç</h1>
                <form action="login.php" method="POST">
                    <label for="username">Kullanıcı Adı:</label>
                    <input type="text" id="username" name="username" placeholder="Kullanıcı Adı" required>
                    <label for="password">Şifre:</label>
                    <input type="password" id="password" name="password" placeholder="Şifre" required>
                    <button type="submit">Giriş Yap</button>
                </form>
                <p id="errorMessage" style="color: red; display: none;">Geçersiz giriş bilgileri!</p>
            </div>

            <div class="rec-container">
                <h1 style="text-align:left;">Giriş yapmanız tavsiye edilir</h1>
                <ul class="recommendations">
                    <li><img src="images/check-circle.svg"> Hızlı ödeme</li>
                    <li><img src="images/check-circle.svg"> Siparişlerinizi takip edin</li>
                    <li><img src="images/check-circle.svg"> Ayrıcalıklı tekliflere erişin</li>
                </ul>
            </div>
            <p class="recaptcha-note">
                This site is protected by reCaptcha. <a href="#">Google Privacy Policy</a> applies as well as <a href="#">their terms of service</a>.
            </p>
        </div>
    </div>
</body>
</html>
