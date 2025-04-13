<?php
$product_id = $_GET['remove_product'];
$query = $conn->prepare('DELETE FROM `products` WHERE product_id = ? ');
$query->bind_param('i', $product_id);
$query->execute();
header("Location: index.php?view_product");
?>