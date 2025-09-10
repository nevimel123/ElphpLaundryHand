<?php
include '../includes/db.php';

if (isset($_POST['id'], $_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $allowed = ['Pending', 'Washing', 'Ready to Pick Up', 'Picked Up'];
    if (!in_array($status, $allowed)) {
        echo "Invalid status.";
        exit;
    }

    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating order.";
    }
}
?>
