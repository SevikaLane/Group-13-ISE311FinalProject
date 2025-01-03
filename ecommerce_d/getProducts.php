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
    <title>Ürün Listesi</title>
    <style>
        /* PHP VE API icin eklendi */
        .product-card {
            position: relative;
            width: 220px;
            height: 330px;
            background-color: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            margin-top: 10px;
        }

        .product-info h3 {
            font-size: 18px;
            margin: 0;
            font-weight: 600;
        }

        .product-info p {
            font-size: 14px;
            color: #777;
            margin: 5px 0;
        }

        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #e91e63;
        }

        .product-card a {
            text-decoration: none;
            color: #fff;
            background-color: #e91e63;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .product-card a:hover {
            background-color: #d81b60;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Ürün Listesi</h1>
    <div class="product-list">
        <?php
        // Veritabanından gelen ürünleri listeliyoruz
        if (!empty($products)) {
            foreach ($products as $product) {
                echo '<div class="product-card">';
                echo '<img src="images/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';


                echo '<div class="product-info">';
                echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                echo '<p>' . htmlspecialchars($product['description']) . '</p>';
                echo '<p class="product-price">' . htmlspecialchars($product['price']) . ' USD</p>';
                echo '<a href="#">Satın Al</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Ürün bulunamadı.</p>';
        }
        ?>
    </div>
</body>
</html>
