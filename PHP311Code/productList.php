<?php
// Veritabanından ürün verilerini çekme (getProducts.php'den alınan JSON verisini kullanabiliriz)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_d";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT * FROM producttable";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spor Aksesuarları Fiyatları & Sporcu Aksesuarları | Decathlon</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="StyleAccessories.css">
    <style>
        /* Styles will be included here, if necessary */
    </style>
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
            <button class="search-button">
                ⌕
             </button>
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
                        <img src="images/shop.png" style="width:25px;height:auto;" alt="Soru">
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
    <li class="menu-item">
      <a href="#" style="font-weight:bold;color:#3844bc;">Sporlar <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Futbol</a></li>
        <li><a href="#">Basketbol</a></li>
        <li><a href="#">Yüzme</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Kadın <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="productList.php">Kıyafetler</a></li>
        <li><a href="productList.php">Aksesuarlar</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Erkek <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Kıyafetler</a></li>
        <li><a href="#">Ayakkabılar</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Çocuk <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Oyuncaklar</a></li>
        <li><a href="#">Kıyafetler</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="productList.php">Aksesuarlar <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Çantalar</a></li>
        <li><a href="#">Saatler</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Ekipmanlar<span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Çantalar</a></li>
        <li><a href="#">Saatler</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Tüm Ürünler <span class="arrow">&#11167</span></a>
      <ul class="dropdown">
        <li><a href="#">Yeni Ürünler</a></li>
        <li><a href="#">Kampanyalar</a></li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="#">Sporcu Besinleri</a>
    </li>
    <li class="menu-item">
      <a href="#">Decathlon Member</a>
    </li>
  </ul>
</nav>
</header>

<div class="category-header">
    <div class="category-icon"></div>
    <h1>SPOR AKSESUARLARI</h1>
</div>

<div class="filter-tags">
    <div class="filter-tag">Çantalar <span>(260)</span></div>
    <div class="filter-tag">Eldivenler <span>(61)</span></div>
    <div class="filter-tag">Çoraplar <span>(112)</span></div>
    <div class="filter-tag">Bereler <span>(40)</span></div>
    <div class="filter-tag">Şapkalar <span>(59)</span></div>
    <div class="filter-tag">Boyunluklar ve Bandanalar <span>(36)</span></div>
    <div class="filter-tag">Valiz ve Seyahat Çantaları <span>(12)</span></div>
    <div class="filter-tag">Saatler <span>(32)</span></div>
    <div class="filter-tag">Güneş Gözlükleri <span>(28)</span></div>
</div>

<main class="main-content" style="margin-bottom:10rem;">
    <aside class="filters">
        <div class="filter-section">
            <div class="filter-header">
                <h3>Filtre</h3>
            </div>
        </div>

        <div class="filter-section">
            <h3 class="filter-title">Ürün türü</h3>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox">
                    <span>Bağlı renkli desteği (1)</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox">
                    <span>Bere (72)</span>
                </label>
            </div>
            <div class="show-more">+ Daha fazla filtre</div>
        </div>

        <div class="filter-section">
            <h3 class="filter-title">Beden</h3>
            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox">
                    <span>Tek beden (459)</span>
                </label>
                <label class="filter-option">
                    <input type="checkbox">
                    <span>38 (168)</span>
                </label>
            </div>
            <div class="show-more">+ Daha fazla filtre</div>
        </div>

        <div class="filter-section">
            <h3 class="filter-title">Renk</h3>
            <div class="filter-options">
                <label class="color-option">
                    <span class="color-swatch" style="background-color: black;"></span>
                    <span>Siyah</span>
                </label>
                <label class="color-option">
                    <span class="color-swatch" style="background-color: #0066cc;"></span>
                    <span>Mavi</span>
                </label>
            </div>
            <div class="show-more">+ Daha fazla filtre</div>
        </div>
    </aside>

    <section class="products">
        <div class="sorting">
            <select class="sort-select">
                <option>Sıralama (Önerilen)</option>
                <option>Fiyat: Düşükten yükseğe</option>
                <option>Fiyat: Yüksekten düşüğe</option>
            </select>
        </div>
        <div class="product-grid" style="grid-template-columns: repeat(4, 1fr);">
    <?php
    foreach ($products as $product) {
        // Fixing the image path and adding an error fallback
        $imagePath = "../ecommerce_d/images/" . htmlspecialchars($product['image']);
        echo '<a href="item.php?id=' . htmlspecialchars($product['id']) . '" class="product-item">';
        echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($product['name']) . '" onerror="this.onerror=null; this.src=\'../ecommerce_d/images/placeholder.jpg\';">';
        echo '<div class="product-info">';
        echo '<p class="product-price"><span class="price-number">₺' . htmlspecialchars($product['price']) . '</span></p>';
        echo '<p class="product-name"><b>' . htmlspecialchars($product['name']) . '</b></p>';
        echo '<p class="product-name" style="font-size: 0.8rem;">' . htmlspecialchars($product['description']) . '</p>';
        echo '</div>';
        echo '</a>';
    }
    ?>
</div>

    </section>
</main>

<div class="footer-bottom-container">

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
</html>
