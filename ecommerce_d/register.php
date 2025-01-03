<?php
session_start();
include('config.php'); 


function sendResponse($status, $message) {
    echo json_encode([
        'status' => $status,
        'message' => $message
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

   
    if ($password === $confirm_password) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                sendResponse("success", "Kayıt başarılı! Giriş yapabilirsiniz.");
            } else {
                sendResponse("error", "Hata: " . $conn->error);
            }

            $stmt->close();
        } else {
            sendResponse("error", "Sorgu hazırlanırken bir hata oluştu.");
        }
    } else {
        sendResponse("error", "Şifreler uyuşmuyor!");
    }
}
?>

<!-- Kayıt Formu -->
<form action="register.php" method="POST">
    <label for="username">Kullanıcı Adı:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Şifre:</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Şifreyi Onayla:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <button type="submit" name="register">Kayıt Ol</button>
</form>
