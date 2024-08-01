<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $update_status = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
    $update_status->execute([$order_status, $order_id]);
    $message[] = 'Order status updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>
    <link rel="shortcut icon" href="../images/head.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="placed-orders">
    <h1 class="heading">Placed Orders</h1>
    <div class="box-container">
        <?php
        $select_orders = $conn->prepare("SELECT * FROM `orders`");
        $select_orders->execute();
        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <p> User ID: <span><?= $fetch_orders['user_id']; ?></span> </p>
            <p> Placed on: <span><?= $fetch_orders['placed_on']; ?></span> </p>
            <p> Name: <span><?= $fetch_orders['name']; ?></span> </p>
            <p> Email: <span><?= $fetch_orders['email']; ?></span> </p>
            <p> Number: <span><?= $fetch_orders['number']; ?></span> </p>
            <p> Address: <span><?= $fetch_orders['address']; ?></span> </p>
            <p> Total Products: <span><?= $fetch_orders['total_products']; ?></span> </p>
            <p> Total Price: <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span> </p>
            <p> Payment Method: <span><?= $fetch_orders['method']; ?></span> </p>
            <p> Order Status: <span><?= $fetch_orders['order_status']; ?></span> </p>
            <?php if ($fetch_orders['order_status'] == 'pending' || $fetch_orders['order_status'] == 'request refund') { ?>
            <form action="" method="POST">
                <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                <select name="order_status" class="drop-down">
                    <option value="" selected disabled><?= $fetch_orders['order_status']; ?></option>
                    <?php if ($fetch_orders['order_status'] == 'pending') { ?>
                    <option value="approved">approved</option>
                    <?php } elseif ($fetch_orders['order_status'] == 'request refund') { ?>
                    <option value="refunded">refunded</option>
                    <?php } ?>
                </select>
                <div class="flex-btn">
                    <input type="submit" value="Update" class="btn" name="update_status">
                </div>
            </form>
            <?php } ?>
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No orders placed yet!</p>';
        }
        ?>
    </div>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>