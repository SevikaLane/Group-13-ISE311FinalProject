<?php
// Backend yapılandırmasını dahil et
require_once '../ecommerce_d/config.php';
require_once '../ecommerce_d/text_connection.php';

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

// Backend üzerinden veri çekme örneği
$response = file_get_contents('http://localhost/ecommerce_d/products.php');
$data = json_decode($response, true);

if (!$data) {
} else {
    echo "<h1>Ürün Listesi</h1>";
    echo "<ul>";
    foreach ($data as $item) {
        echo "<li>" . htmlspecialchars($item['name']) . " - " . htmlspecialchars($item['price']) . "</li>";
    }
    echo "</ul>";
}
?>  


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Decathlon | Türkiye'nin En Büyük Spor Giyim ve Malzeme Mağazası</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    
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

<div class="slideshow-container">
       
        <div class="slide">
            <img src="images/slide1.avif" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="images/slide2.avif" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="images/slide3.avif" alt="Slide 3">
        </div>

        <a class="prev" onclick="changeSlide(-1)">❮</a>
        <a class="next" onclick="changeSlide(1)">❯</a>
    </div>

    <!-- Navigation Dots -->
    <div class="dots-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

<!-- CREATE MARGIN FOR THE ELEMENTS AFTER SLIDEHSOW -->

<div class="category-button-container">
   
    <a href="#" class="category-button">
        <img src="images/sporlar.png" alt="Sports">
        <span>SPORLAR</span>
    </a>

    <a href="#" class="category-button">
        <img src="images/kadin.webp" alt="Kadın">
        <span>KADIN</span>
    </a>

    <a href="#" class="category-button">
        <img src="images/erkek.webp" alt="Erkek">
        <span>ERKEK</span>
    </a>

    <a href="#" class="category-button">
        <img src="images/cocuk.webp" alt="Çocuk">
        <span>ÇOCUK</span>
    </a>

    <a href="productList.php" class="category-button">
        <img src="images/aksesuar.png" alt="Aksesuarlar">
        <span>AKSESUAR</span>
    </a>

    <!-- Special Red Button -->
    <a href="#" class="category-button" style="background-color:red;color:white;">
        <img src="images/indirim.webp" alt="İndirim">
        <span>SERI SONU</span>
    </a>
</div>

<a href="#" class="campaign-image-link">
    <img src="images/iyizco-kampanya.jpg" alt="Kampanya">
</a>


<div class="display-categories-container">
    <h2>POPÜLER KATEGORİLER</h2>

    <div class="display-categories-item-container">
        <a href="#" class="display-categories-item">
            <img src="images/botlar.avif" alt="Botlar">
            <span>BOTLAR</span>
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/polarlar.avif" alt="Polarlar">
            <span>POLARLAR</span>
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/montlar.avif" alt="Montlar">
            <span>MONTLAR</span>
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/iclikler.avif" alt="İçlikler">
            <span>İÇLİKLER</span>
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/eldivenler.avif" alt="Eldivenler">
            <span>ELDİVENLER</span>
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/pantolonlar.avif" alt="Pantolonlar">
            <span>PANTOLONLAR</span>
        </a>
    </div>
</div>

<div class="display-categories-container">
    <h2>YILBAŞI HEDİYE ÖNERİLERİ</h2>

    <div class="display-categories-item-container">
        <a href="#" class="display-categories-item">
            <img src="images/dispcat1.avif" alt="Botlar">
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/dispcat2.avif" alt="Polarlar">
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/dispcat3.avif" alt="Montlar">
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/dispcat4.avif" alt="İçlikler">
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/dispcat5.avif" alt="Eldivenler">
        </a>

        <a href="#" class="display-categories-item">
            <img src="images/dispcat6.avif" alt="Pantolonlar">
        </a>
    </div>
</div>

<div class="product-container">
    <div class="big-image">
        <img src="images/promo-pic-2.avif" alt="Promotion Pic">
    </div>

    <div class="product-grid">
        <a href="#" class="product-item">
            <img src="images/product1-hp.jpg" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>ARTENGO</b></p>
                <p class="product-name">Tenis Çorabı - Uzun Konçlu - 3'lü Paket - Beyaz - RS 500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product2-hp.jpg" alt="Beanie">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Kayak Beresi - Siyah - Simple</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product3-hp.jpg" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>FORCLAZ</b></p>
                <p class="product-name">Yetişkin Outdoor Trekking Polar Eldiven - Siyah - MT500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product4-hp.jpg" alt="Scarf">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Boyunluk - Siyah - Firstheat</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product5-hp.jpg" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>KIPSTA</b></p>
                <p class="product-name">Yetişkin Kaleci Eldiveni - Siyah - Keepwarm</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product6-hp.jpg" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>SOLOGNAC</b></p>
                <p class="product-name">Uzun Kışlık Çorap - Avcılık ve Doğa Gözlem - 2 Çift - ACT 100</p>
            </div>
        </a>
    </div>
</div>

<div class="product-container right">


    <div class="product-grid">
        <a href="#" class="product-item">
            <img src="images/product7-hp.avif" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺350</span>
                </p>
                <p class="product-name"><b>ARTENGO</b></p>
                <p class="product-name">Tenis Çorabı - Uzun Konçlu - 3'lü Paket - Beyaz - RS 500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product8-hp.avif" alt="Beanie">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺350</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Kayak Beresi - Siyah - Simple</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product9-hp.avif" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺3.790</span>
                </p>
                <p class="product-name"><b>FORCLAZ</b></p>
                <p class="product-name">Yetişkin Outdoor Trekking Polar Eldiven - Siyah - MT500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product10-hp.avif" alt="Scarf">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺3.790</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Boyunluk - Siyah - Firstheat</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product11-hp.avif" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺1.390</span>
                </p>
                <p class="product-name"><b>KIPSTA</b></p>
                <p class="product-name">Yetişkin Kaleci Eldiveni - Siyah - Keepwarm</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product12-hp.avif" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺1.790</span>
                </p>
                <p class="product-name"><b>SOLOGNAC</b></p>
                <p class="product-name">Uzun Kışlık Çorap - Avcılık ve Doğa Gözlem - 2 Çift - ACT 100</p>
            </div>
        </a>

    </div>

    <div class="big-image">
        <img src="images/promo-pic-3.avif" alt="Promotion Pic">
    </div>

</div>

<div class="product-container">

    <div class="big-image">
        <img src="images/promo-pic-2.avif" alt="Promotion Pic">
    </div>

    <div class="product-grid">
        <a href="#" class="product-item">
            <img src="images/product13-hp.avif" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>ARTENGO</b></p>
                <p class="product-name">Tenis Çorabı - Uzun Konçlu - 3'lü Paket - Beyaz - RS 500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product14-hp.avif" alt="Beanie">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Kayak Beresi - Siyah - Simple</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product15-hp.avif" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>FORCLAZ</b></p>
                <p class="product-name">Yetişkin Outdoor Trekking Polar Eldiven - Siyah - MT500</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product16-hp.avif" alt="Scarf">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>WEDZE</b></p>
                <p class="product-name">Yetişkin Boyunluk - Siyah - Firstheat</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product17-hp.avif" alt="Gloves">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>KIPSTA</b></p>
                <p class="product-name">Yetişkin Kaleci Eldiveni - Siyah - Keepwarm</p>
            </div>
        </a>

        <a href="#" class="product-item">
            <img src="images/product18-hp.avif" alt="Socks">
            <div class="product-info">
                <p class="product-price">
                    <span class="price-number">₺195</span>
                </p>
                <p class="product-name"><b>SOLOGNAC</b></p>
                <p class="product-name">Uzun Kışlık Çorap - Avcılık ve Doğa Gözlem - 2 Çift - ACT 100</p>
            </div>
        </a>
    </div>
</div>
 
<a href="#" class="campaign-image-link" style="margin-top: 10px;margin-bottom:50px;">
    <img src="images/max-kampanya.jpg" alt="Kampanya">
</a>

<div class="category-button-container">
    <a href="#" class="category-button" style="padding: 20px 75px;">
        <span>QUECHUA</span>
    </a>

    <a href="#" class="category-button" style="padding: 20px 75px;">
        <span>WEDZE</span>
    </a>

    <a href="#" class="category-button" style="padding: 20px 75px;">
        <span>DOMYOS</span>
    </a>

    <a href="#" class="category-button" style="padding: 20px 75px;">
        <span>KIPSTA</span>
    </a>

    <a href="#" class="category-button" style="padding: 20px 75px;">
        <span>KALENJI</span>
    </a>

    <!-- Special Red Button -->
    <a href="#" class="category-button" style="padding: 20px 90px;">
        <span>BTWIN</span>
    </a>
</div>

<div class="features-container">
    <div class="feature-item">
        <img src="images/feature1.avif" alt="Free Shipping">
        <h3>4500 ₺ Üzeri Kargo Bedava</h3>
        <p>4500 TL üzeri siparişlerinizde kargo bedava</p>
    </div>
    <div class="feature-item">
        <img src="images/feature2.avif" alt="Credit Card Payment">
        <h3>Kredi Kartı ile Ödeme</h3>
        <p>Taksitli ödeme kolaylığıyla alışveriş yapabilirsiniz</p>
    </div>
    <div class="feature-item">
        <img src="images/feature3.avif" alt="Store Delivery">
        <h3>Mağazadan Ücretsiz Teslimat</h3>
        <p>Siparişlerinizi seçtiğiniz mağazadan teslim alabilirsiniz!</p>
    </div>
    <div class="feature-item">
        <img src="images/feature4.avif" alt="Same Day Delivery">
        <h3>Mağazadan Aynı Gün Teslimat</h3>
        <p>Mağazadan teslim alacağınız siparişlerinizi aynı gün teslim alabilirsiniz</p>
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
<script src="script.js"></script> <!-- Script for SLIDESHOW-->
</html>