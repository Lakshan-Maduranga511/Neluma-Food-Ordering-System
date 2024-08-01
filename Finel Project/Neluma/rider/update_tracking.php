<?php

include '../components/connect.php';

session_start();

if (!isset($_SESSION['rider_id'])) {
    header('Location: login.php');
    exit();
}
$rider_id = $_SESSION['rider_id'];

if (isset($_POST['update_tracking'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $update_status = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
    $update_status->execute([$order_status, $order_id]);
    $message[] = 'Order status updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tracking</title>
    <link rel="shortcut icon" href="../images/head.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/rider_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include '../components/rider_header.php'; ?>

<section class="placed-orders">

    <h1 class="heading">Update Tracking</h1>

    <div class="box-container">

        <?php
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE rider_id = ? AND order_status NOT IN ('delivered', 'received the money', 'parcel returned')");
        $select_orders->execute([$rider_id]);
        if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                $order_id = $fetch_orders['id'];
                $order_status = $fetch_orders['order_status'];
                $method = $fetch_orders['method'];
                ?>
                <div class="box">
                    <p>Order ID: <span><?= $order_id; ?></span></p>
                    <p>User ID: <span><?= $fetch_orders['user_id']; ?></span></p>
                    <p>Placed on: <span><?= $fetch_orders['placed_on']; ?></span></p>
                    <p>Name: <span><?= $fetch_orders['name']; ?></span></p>
                    <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
                    <p>Number: <span><?= $fetch_orders['number']; ?></span></p>
                    <p>Address: <span><?= $fetch_orders['address']; ?></span></p>
                    <p>Total Products: <span><?= $fetch_orders['total_products']; ?></span></p>
                    <p>Total Price: <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span></p>
                    <p>Payment Method: <span><?= $method; ?></span></p>
                    <form action="" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                        <select name="order_status" class="drop-down">
                            <?php if ($order_status !== 'out for deliver') { ?>
                                <option value="out for deliver">Out for Deliver</option>
                            <?php } ?>
                            <?php if ($order_status !== 'delivered') { ?>
                                <option value="delivered">Delivered</option>
                            <?php } ?>
                            <?php if ($method === 'cash on delivery' && $order_status !== 'received the money') { ?>
                                <option value="received the money">Received the Money</option>
                            <?php } ?>
                            <?php if ($order_status !== 'parcel returned') { ?>
                                <option value="parcel returned">Parcel Returned</option>
                            <?php } ?>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" value="Update" class="btn" name="update_tracking">
                        </div>
                    </form>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No orders ready to deliver yet!</p>';
        }
        ?>

    </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>