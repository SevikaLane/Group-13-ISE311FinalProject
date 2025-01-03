<?php
include 'config.php';


$sql = "SELECT * FROM producttable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Ürünler</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Ürün Adı</th><th>Açıklama</th><th>Fiyat</th><th>Resim</th><th>Stok</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . " TL</td>";
        echo "<td><img src='images/" . $row['image'] . "' width='100'></td>";
        echo "<td>" . $row['stock'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Hiç ürün bulunamadı.";
}

$conn->close();
?>
