<?php
// Session başlatılması
session_start();

// Veritabanı bağlantısı
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ecommerce_d'; // Veritabanı adı

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sepet kontrolü
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Sepetiniz boş.";
    exit();
}

// Ürün bilgilerini al
$product_ids = [];
foreach ($_SESSION['cart'] as $item) {
    $product_ids[] = $item['product_id'];
}

$placeholders = implode(',', array_fill(0, count($product_ids), '?'));
$sql = "SELECT * FROM producttable WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Sepetteki ürünlerin detaylarını almak için döngü
$total_price = 0;
foreach ($_SESSION['cart'] as &$cart_item) {
    foreach ($products as $product) {
        if ($product['id'] == $cart_item['product_id']) {
            $cart_item['product'] = $product;
            $total_price += $product['price'] * $cart_item['quantity'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet | Decathlon</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StyleCheckout.css">
</head>
<body>
<header class="main-header">
    <div class="header-top">
        <a href="index.php" class="link-wrapper" style="margin: 20px 0 0 20px;">
            <img src="images/home.svg" alt="Anasayfa">
            <span>Anasayfa</span>
        </a>
        <div class="logo" style="margin-left:600px;">
            <a href="index.php">
                <img src="images/DecLogo.png" alt="Logo">
            </a>
        </div>
        <div class="user-links">
            <div class="link-item">
                <a href="#" class="link-wrapper">
                    <img src="images/help-circle.svg" alt="Soru">
                    <span>Bize Ulaşın</span>
                </a>
            </div>
        </div>
        <div class="user-links">
            <div class="link-item">
                <a href="#" class="link-wrapper">
                    <img src="images/safety.png" alt="100% Safety">
                    <span>GÜVENLİ</span>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="checkout-steps">
    <div class="step active">
        <div class="step-number">1</div>
        <span>Sepet</span>
    </div>
    <div class="step">
        <div class="step-number">2</div>
        <span>Giriş</span>
    </div>
    <div class="step">
        <div class="step-number">3</div>
        <span>Teslimat</span>
    </div>
    <div class="step">
        <div class="step-number">4</div>
        <span>Ödeme</span>
    </div>
</div>

<main class="main-content">
    <section class="cart-section">
        <h2>Sepetim</h2>

        <?php foreach ($_SESSION['cart'] as $item): ?>
        <div class="product-card">
        <?php
    $imagePath = "../ecommerce_d/images/" . htmlspecialchars($item['product']['image']);
    ?>
    <img src="<?php echo $imagePath; ?>" 
        alt="<?php echo htmlspecialchars($item['product']['name']); ?>" 
        class="product-image"
        onerror="this.onerror=null; this.src='../ecommerce_d/images/placeholder.jpg';">

            <div class="product-info">
                <h3><?php echo htmlspecialchars($item['product']['name']); ?></h3>
                <p><?php echo htmlspecialchars($item['product']['name']); ?></p>
                
            </div>
            <div class="quantity-controls">
                <button class="quantity-btn">-</button>
                <span><?php echo htmlspecialchars($item['quantity']); ?></span>
                <button class="quantity-btn">+</button>
            </div>
            <div class="price"><?php echo htmlspecialchars($item['product']['price']); ?> TL</div>
        </div>
        <?php endforeach; ?>
    </section>
    
    <div class="order-summary-container">
    <h2>Sipariş Özeti</h2>
        <aside class="order-summary">
            <div class="summary-details">
                <p>
                    <span>Ara toplam (<?php echo count($_SESSION['cart']); ?> adet)</span>
                    <span><?php echo $total_price; ?> TL</span>
                </p>
                <p>
                    <span>Kargo</span>
                    <span class="shipping-note">Bir sonraki adımda hesaplanacak</span>
                </p>
            </div>

            <button class="checkout-btn">SEPETİ ONAYLA</button>

            <div class="features">
                <div class="feature-item">
                    <span>✓</span>
                    <span>Kolay İade ve Değişim Garantisi</span>
                </div>
                <div class="feature-item">
                    <span>✓</span>
                    <span>Mağazadan Ücretsiz Teslimat</span>
                </div>
                <div class="feature-item">
                    <span>✓</span>
                    <span>Taksit İmkanı</span>
                </div>
                <div class="feature-item">
                    <span>✓</span>
                    <span>Güvenli Ödeme</span>
                </div>
            </div>
        </aside>
    </div>
</main>

<script>
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const isIncrement = e.target.textContent === '+';
            const quantitySpan = btn.parentElement.querySelector('span');
            let quantity = parseInt(quantitySpan.textContent);
            
            if (isIncrement) {
                quantity++;
            } else if (quantity > 1) {
                quantity--;
            }
            
            quantitySpan.textContent = quantity;
            // API call would go here to update cart
        });
    });

    document.querySelector('.checkout-btn').addEventListener('click', () => {
        // Proceed to next step
    });
</script>

</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını burada kapatıyoruz
?>
