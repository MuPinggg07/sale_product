<?php
session_start();

if (isset($_SESSION['product_names']) && !empty($_SESSION['product_names'])) {
    $product_names = $_SESSION['product_names'];
    echo "<h2>Ordered Products:</h2><ul>";
    foreach ($product_names as $name) {
        echo "<li>" . htmlspecialchars($name) . "</li>";
    }
    echo "</ul>";
    unset($_SESSION['product_names']); // Clear session data after use
} else {
    echo "No products to display.";
}
?>
