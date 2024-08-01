<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
   exit;
};

if (isset($_POST['update_order_status'])) {
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
   <title>orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<div class="heading">
   <h3>orders</h3>
   <p><a href="html.php">home</a> <span> / orders</span></p>
</div>

<section class="orders">

   <h1 class="title">your orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo "<script>alert('please login to see your orders');</script>";
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
               $order_id = $fetch_orders['id'];
               $order_status = $fetch_orders['order_status'];
               $method = $fetch_orders['method'];
   ?>
   <div class="box">
      <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>payment method : <span><?= $method; ?></span></p>
      <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>total price : <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>order status : <span style="color:<?php if($order_status == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $order_status; ?></span></p>

      <?php if ($order_status == 'delivered') { ?>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $order_id; ?>">
            <select name="order_status" class="drop-down">
               <option value="order received">Order Received</option>
            </select>
            <input type="submit" value="confirm" class="btn" name="update_order_status">
         </form>
      <?php } elseif ($order_status == 'parcel returned' && $method == 'credit card') { ?>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $order_id; ?>">
            <select name="order_status" class="drop-down">
               <option value="request refund">Request Refund</option>
            </select>
            <input type="submit" value="confirm" class="btn" name="update_order_status">
         </form>
      <?php } elseif ($order_status == 'refunded') { ?>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $order_id; ?>">
            <select name="order_status" class="drop-down">
               <option value="refund received">Refund Received</option>
            </select>
            <input type="submit" value="confirm" class="btn" name="update_order_status">
         </form>
      <?php } ?>
   </div>
   <?php
      }
      }else{
         echo "<script>alert('no orders placed yet!');</script>";
      }
      }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>