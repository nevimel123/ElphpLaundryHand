<?php
include '../includes/db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM orders WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Order deleted successfully.";
    } else {
        echo "Error deleting order.";
    }
}
?>
