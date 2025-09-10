<?php
include '../includes/db.php';

// Fetch orders with customer names
$query = "SELECT o.id, o.status, o.order_date, u.name AS customer_name 
          FROM orders o
          JOIN users u ON o.customer_id = u.id
          ORDER BY o.order_date DESC";
$result = $conn->query($query);
?>

<div id="ordersSection">
    <h4 class="text-primary fw-bold mb-3">All Orders</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="fw-bold"><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td>
                        <span class="badge bg-info"><?= $row['status'] ?></span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" 
                            onclick="editOrder('<?= $row['id'] ?>','<?= $row['status'] ?>')">Edit</button>
                        <button class="btn btn-sm btn-danger" 
                            onclick="deleteOrder('<?= $row['id'] ?>')">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
