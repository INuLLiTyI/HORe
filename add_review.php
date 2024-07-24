<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ozon_reviews";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$name = $_POST['name'];
$review = $_POST['review'];
$rating = (float)$_POST['rating']; // Преобразование к float
$product_id = (int)$_POST['product_id'];

// Вставка отзыва в базу данных
$sql = "INSERT INTO reviews (product_id, name, review, rating, created_at) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issd", $product_id, $name, $review, $rating);

if ($stmt->execute()) {
    echo "Review added successfully";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
