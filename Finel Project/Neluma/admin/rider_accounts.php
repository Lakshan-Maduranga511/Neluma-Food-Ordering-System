<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_rider = $conn->prepare("DELETE FROM `rider` WHERE id = ?");
   $delete_rider->execute([$delete_id]);
   header('location:rider_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>riders accounts</title>
   <link rel="shortcut icon" href="../images/head.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<section class="accounts">

   <h1 class="heading">riders account</h1>

   <div class="box-container">

   <div class="box">
      <p>register new rider</p>
      <a href="../rider/register_rider.php" class="option-btn">register</a>
   </div>

   <?php
      $select_account = $conn->prepare("SELECT * FROM `rider`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> rider id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="rider_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>





















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>