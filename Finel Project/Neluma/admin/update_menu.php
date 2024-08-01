<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];

   $update_category = $conn->prepare("UPDATE `menu` SET catname = ? WHERE catid = ?");
   $update_category->execute([$name, $pid]);

   $message[] = 'category updated!';


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update category</title>
   <link rel="shortcut icon" href="../images/head.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<section class="update-category">

   <h1 class="heading">update category</h1>

   <?php
      $update_id = $_GET['update'];
      $show_category = $conn->prepare("SELECT * FROM `menu` WHERE catid = ?");
      $show_category->execute([$update_id]);
      if($show_category->rowCount() > 0){
         while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_category['catid']; ?>">
      <span>update name</span>
      <input type="text" required placeholder="enter category name" name="name" maxlength="100" class="box" value="<?= $fetch_category['catname']; ?>">
    
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="menu.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no category added yet!</p>';
      }
   ?>

</section>




<script src="../js/admin_script.js"></script>

</body>
</html>