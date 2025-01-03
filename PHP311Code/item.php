<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ecommerce_d'; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$product_id = $_GET['id'];


$sql = "SELECT * FROM producttable WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   
    $product = $result->fetch_assoc();
} else {
    echo "Ürün bulunamadı.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    session_start();

    
    $_SESSION['cart'][] = [
        'product_id' => $_POST['product_id'],
        'quantity' => $_POST['quantity']
    ];

   
    header("Location: checkout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StyleItem.css">
</head>
<body>
<header class="main-header">
    <div class="header-top">
        <a href="#" class="link-wrapper" style="margin: 20px 20px 0 0;">
            <img src="images/menu.svg" alt="Menu">
            <span>Menü</span>
        </a>
        <div class="logo">
            <a href="index.php">
                <img src="images/DecLogo.png" alt="Logo">
            </a>
        </div>
        <div class="search-wrapper">
            <input type="text" class="search-input" placeholder="Bir ürün, spor veya marka arayın...">
            <button class="search-button">⌕</button>
        </div>
        <div class="user-links">
            <div class="link-item">
                <a href="#" class="link-wrapper">
                    <img src="images/help-circle.svg" alt="Soru">
                    <span>Bize Ulaşın</span>
                </a>
            </div>
            <div class="link-item">
                <a href="#" class="link-wrapper">
                    <img src="images/shop.png" style="width:25px;height:auto;" alt="Mağaza">
                    <span>Mağaza Bul</span>
                </a>
            </div>
            <div class="link-item account-dropdown">
                <a href="#" class="link-wrapper">
                    <img src="images/user.svg" alt="Hesap">
                    <span>Hesabım</span>
                </a>
                <ul class="account-menu">
                    <li><a href="login.php">Giriş Yap</a></li>
                </ul>
            </div>
            <div class="link-item">
                <a href="checkout.php" class="link-wrapper">
                    <img src="images/shopping-cart.svg" alt="Sepet">
                    <span>Sepetim</span>
                </a>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <ul class="menu">
            <li class="menu-item"><a href="#">Sporlar <span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="#">Kadın <span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="#">Erkek <span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="#">Çocuk <span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="productList.php">Aksesuarlar <span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="#">Ekipmanlar<span class="arrow">&#11167</span></a></li>
            <li class="menu-item"><a href="#">Tüm Ürünler <span class="arrow">&#11167</span></a></li>
        </ul>
    </nav>
</header>

<nav class="nav-breadcrumb">
    <a href="index.php">Decathlon</a> / <a href="#">Tüm Sporlar</a> / <a href="productList.php">Spor Aksesuarları</a>
</nav>

<div class="main-content">
    <div class="product-gallery">
        <div class="gallery-item">
        <?php
$imagePath = "../ecommerce_d/images/" . htmlspecialchars($product['image']);
?>
<img src="<?php echo $imagePath; ?>" 
     alt="<?php echo htmlspecialchars($product['name']); ?>" 
     onerror="this.onerror=null; this.src='../ecommerce_d/images/placeholder.jpg';">

        </div>
    </div>

    <div class="product-info">
        <div class="product-brand"><?php echo htmlspecialchars($product['name']); ?></div>
        <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="product-price"><?php echo htmlspecialchars($product['price']); ?> TL</div>
        <div class="ref-number">Ref : <?php echo htmlspecialchars($product['id']); ?></div>
        <div class="product-description"><?php echo htmlspecialchars($product['description']); ?></div>

        <div class="size-selector">
            <div class="size-label">
                <span>Beden:</span>
                <a href="#" class="size-guide">Beden kılavuzu</a>
            </div>
            <select>
                <option>Beden seçin</option>
            </select>
        </div>

        <!-- Sepete Ekleme Formu -->
        <form id="add-to-cart-form" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Miktar:</label>
            <input type="number" name="quantity" id="quantity" min="1" max="10" value="1">
            <button type="submit" class="add-to-cart">Sepete Ekle</button>
        </form>

        <div class="loyalty-points">
            <img src="images/points.webp" style="width:1rem;height:1rem;"alt="Points icon">
            <span>Alışveriş sana ulaştıktan sonra kazanacağın puan: 120</span>
        </div>
    </div>
</div>

<div class="item-detailed-exp">
    <div class="item-detailed-exp-item">ÜRÜN FAYDALARI</div>
    <div class="item-detailed-exp-item">BENZER ÜRÜNLER</div>
    <div class="item-detailed-exp-item">BİRLİKTE ALINAN ÜRÜNLER</div>
    <div class="item-detailed-exp-item">TEKNİK BİLGİLER</div>
    <div class="item-detailed-exp-item">ÜRÜN KONSEPTİ VE TEKNOLOJİSİ</div>
    <div class="item-detailed-exp-item">MÜŞTERİ DEĞERLENDİRMELERİ</div>
    <div class="item-detailed-exp-item">DAHA FAZLA BİLGİ</div>
    <div class="item-detailed-exp-item">SON GÖRÜNTÜLENENLER</div>
</div>

</body>
</html>
<div class="reviews-container">
        <h2>Müşteri Değerlendirmeleri</h2>
        <div class="review-summary">
            <div class="rating-overview">
                <div class="average-rating">
                    <h3>4.82 /5</h3>
                    <div class="stars">★★★★★</div>
                    <p>349 Değerlendirme</p>
                    <p>349 Kullanıcı bu ürünü öneriyor</p>
                    <button class="review-button">Değerlendirme Yaz</button>
                    <button class="see-all-reviews">Tüm Değerlendirmeleri Gör</button>
                </div>
                <div class="rating-distribution">
                    <div class="rating-bar">
                        <span>5</span>
                        <div class="bar-container">
                            <div class="bar" style="width: 90%"></div>
                        </div>
                        <span>303</span>
                    </div>
                    <div class="rating-bar">
                        <span>4</span>
                        <div class="bar-container">
                            <div class="bar" style="width: 10%"></div>
                        </div>
                        <span>32</span>
                    </div>
                    <div class="rating-bar">
                        <span>3</span>
                        <div class="bar-container">
                            <div class="bar" style="width: 3%"></div>
                        </div>
                        <span>11</span>
                    </div>
                    <div class="rating-bar">
                        <span>2</span>
                        <div class="bar-container">
                            <div class="bar" style="width: 1%"></div>
                        </div>
                        <span>2</span>
                    </div>
                    <div class="rating-bar">
                        <span>1</span>
                        <div class="bar-container">
                            <div class="bar" style="width: 0.3%"></div>
                        </div>
                        <span>1</span>
                    </div>
                </div>
            </div>
            <div class="review-items">
                <div class="review-item">
                    <div class="reviewer-info">
                        <div>
                            <strong>Sevika Lane | Türkiye </strong>
                            <span> 26.12.2024</span>
                        </div>
                        <span class="verified">✓ Doğrulanmış Alıcı</span>
                    </div>
                    <div class="review-rating">
                        <div class="stars">★★★★★</div>
                        <span>5/5</span>
                        <strong>Güzel</strong>
                    </div>
                    <p>Uzun zamandır kullanıyorum memnunum</p>
                    
                </div>
            </div>
                    
        </div>
    </div>


    <div class="info-bar">
    <a href="#return-policy" class="info-item">
        <img src="images/iade.png" alt="Return Policy">
        <span>60 GÜN İADE</span>
    </a>
    <a href="#free-delivery" class="info-item">
        <img src="images/magaza.png" alt="Free Store Delivery">
        <span>ÜCRETSİZ MAĞAZADAN TESLİMAT</span>
    </a>
    <a href="#warranty" class="info-item">
        <img src="images/garanti.png" alt="2-Year Warranty">
        <span>2 YIL GARANTİ</span>
    </a>
    <a href="#secure-payment" class="info-item">
        <img src="images/odeme.png" alt="Secure Payment">
        <span>GÜVENLİ ÖDEME</span>
    </a>
    <a href="#mobile-apps" class="info-item">
        <img src="images/mobil.png" alt="Mobile Apps">
        <span>MOBİL UYGULAMALARIMIZ</span>
    </a>
</div>

<div class="footer-bottom-container">
<div class="footer-links">
    <div class="footer-column">
        <h3>HAKKIMIZDA</h3>
        <ul>
            <li><a href="#biz-kimiz">Biz Kimiz?</a></li>
            <li><a href="#magazalarimiz">Mağazalarımız</a></li>
            <li><a href="#bize-ulasin">Bize Ulaşın</a></li>
            <li><a href="#uyelik-sozlesmesi">Üyelik Sözleşmesi</a></li>
            <li><a href="#bilgi-toplumu">Bilgi Toplumu Hizmetleri</a></li>
            <li><a href="#insan-kaynaklari">İnsan Kaynakları</a></li>
            <li><a href="#degerlerimiz">Değerlerimiz</a></li>
            <li><a href="#kalite-politikamiz">Kalite Politikamız</a></li>
            <li><a href="#bilgi-guvenligi">Bilgi Güvenliği Politikamız</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>HİZMETLERİMİZ</h3>
        <ul>
            <li><a href="#member-avantajlari">Decathlon Member Avantajları</a></li>
            <li><a href="#magazadan-teslim">Mağazadan Teslim</a></li>
            <li><a href="#garanti-kosullari">Garanti Koşulları</a></li>
            <li><a href="#atolye">Atölye</a></li>
            <li><a href="#sss">SSS</a></li>
            <li><a href="#urun-geri-cagirma">Ürün Geri Çağırma</a></li>
            <li><a href="#magazadan-eve">Mağazadan Eve Teslimat</a></li>
            <li><a href="#ertesi-gun">Ertesi Gün Mağazadan Teslim Al</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>SİPARİŞ</h3>
        <ul>
            <li><a href="#iade-politikasi">İade Politikası</a></li>
            <li><a href="#teslimat-bilgileri">Teslimat Bilgileri</a></li>
            <li><a href="#odeme-secenekleri">Ödeme Seçenekleri</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>POPÜLER KATEGORİLER</h3>
        <ul>
            <li><a href="#kar-botu">Kar Botu</a></li>
            <li><a href="#kislik-ayakkabi">Kışlık Ayakkabı</a></li>
            <li><a href="#kislik-mont">Kışlık Mont</a></li>
            <li><a href="#kadin-mont">Kadın Mont</a></li>
            <li><a href="#erkek-mont">Erkek Mont</a></li>
            <li><a href="#erkek-bot">Erkek Bot</a></li>
            <li><a href="#eldiven">Eldiven</a></li>
            <li><a href="#bere">Bere</a></li>
            <li><a href="#semsiye">Şemsiye</a></li>
            <li><a href="#yagmurluk">Yağmurluk</a></li>
        </ul>
    </div>
</div>

<div class="bottom-section">
    <div class="bottom-links">
        <a href="#uyelik-sozlesmesi">Üyelik Sözleşmesi</a>
        <span>-</span>
        <a href="#kisisel-veriler">Kişisel Verilerin Korunması</a>
        <span>-</span>
        <a href="#yasal-bildirimler">Yasal Bildirimler</a>
        <span>-</span>
        <a href="#cerez-politikasi">Çerez Politikası</a>
        <span>-</span>
        <a href="#gizlilik-guvenlik">Gizlilik ve Güvenlik</a>
        <span>-</span>
        <a href="#bilgi-toplumu">Bilgi Toplumu Hizmetleri</a>
    </div>
    <hr>
    <div class="bottom-copyright">
        © Decathlon - Turksport Spor Ürünleri San. ve Tic. Ltd. Şti. Tüm Hakları Saklıdır.
    </div>
</div>
</div>
    
</body>

    <script>
       
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => {
               
            });
        });

        
        document.querySelector('select').addEventListener('change', (e) => {
           
        });

        
        document.querySelector('.add-to-cart').addEventListener('click', () => {
            
        });
        </script>
</body>
</html>

<?php
$conn->close(); 
?>
