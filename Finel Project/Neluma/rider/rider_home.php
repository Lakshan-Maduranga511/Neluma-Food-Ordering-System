<?php 
session_start();
include '../components/connect.php';

if (!isset($_SESSION['rider_id'])) {
    header('Location: login.php');
    exit();
}

$riderId = $_SESSION['rider_id'];

if (isset($_POST['update_status'])) {
    $orderId = $_POST['id'];
    $sqlUpdate = "UPDATE orders SET order_status = 'ready to deliver', rider_id = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([$riderId, $orderId]);
    $message[] = 'Order status updated!';
}

$sql = "SELECT id, name, number, email, method, address, total_products, total_price, placed_on, order_status 
        FROM orders 
        WHERE order_status = 'approved'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="shortcut icon" href="../images/head.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/rider_style.css">
    <link rel="stylesheet" href="../css/rider.css">
</head>
<body>

<?php include '../components/rider_header.php' ?>
    <div class="container">
        <h1>Order Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Payment Method</th>
                    <th>Customer Address</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Placed On</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($results) {
                    foreach ($results as $row) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['number']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['method']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['total_products']}</td>
                                <td>{$row['total_price']}</td>
                                <td>{$row['placed_on']}</td>";
                                
                        echo "<td>
                                <form action='rider_home.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='update_status' class='approved'>Ready to Deliver</button>
                                </form>
                              </td>";

                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>