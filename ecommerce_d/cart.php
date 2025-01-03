<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_d";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "message" => "Bağlantı hatası: " . $conn->connect_error]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['user_id'], $data['product_id'], $data['quantity']) &&
    is_numeric($data['user_id']) && is_numeric($data['product_id']) && is_numeric($data['quantity'])) {
    
    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];

    // Kullanıcı kontrolü
    $user_check_sql = "SELECT id FROM users WHERE id = ?";
    $user_check_stmt = $conn->prepare($user_check_sql);
    $user_check_stmt->bind_param("i", $user_id);
    $user_check_stmt->execute();
    $user_check_stmt->store_result();
    if ($user_check_stmt->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "Geçersiz kullanıcı ID!"]);
        exit();
    }
    $user_check_stmt->close();

    // Ürün kontrolü
    $product_check_sql = "SELECT id, price FROM producttable WHERE id = ?";
    $product_check_stmt = $conn->prepare($product_check_sql);
    $product_check_stmt->bind_param("i", $product_id);
    $product_check_stmt->execute();
    $product_check_stmt->store_result();
    if ($product_check_stmt->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "Geçersiz ürün ID!"]);
        exit();
    }
    $product_check_stmt->bind_result($product_id_from_db, $product_price);
    $product_check_stmt->fetch();
    $product_check_stmt->close();

    // Sepet verisi ekle
    $sql = "INSERT INTO carts (user_id, product_id, quantity, price) 
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity), price = VALUES(price)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iiid", $user_id, $product_id, $quantity, $product_price);  // Fiyat da parametre olarak ekleniyor

        if ($stmt->execute()) {
            header('Content-Type: application/json');
            echo json_encode(["success" => true, "message" => "Ürün başarıyla sepete eklendi!"]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Hata: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "message" => "Sorgu hazırlama hatası: " . $conn->error]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "message" => "Geçersiz giriş verileri!"]);
}

$conn->close();
?>
