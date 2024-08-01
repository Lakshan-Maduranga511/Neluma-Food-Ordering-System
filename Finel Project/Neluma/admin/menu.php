<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
};

if(isset($_POST['add_category'])){

   $name = $_POST['name'];

   $select_category = $conn->prepare("SELECT * FROM `menu` WHERE catname = ?");
   $select_category->execute([$name]);

   if($select_category->rowCount() > 0){
      $message[] = 'category already exists!';
   }else{

        $insert_category = $conn->prepare("INSERT INTO `menu`(catname) VALUES(?)");
        $insert_category->execute([$name]);

        $message[] = 'new category added!';
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_category = $conn->prepare("DELETE FROM `menu` WHERE catid = ?");
   $delete_category->execute([$delete_id]);
   header('location:menu.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Category</title>
   <link rel="shortcut icon" href="../images/head.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<section class="add-category">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add category</h3>
      <input type="text" required placeholder="enter category name" name="name" maxlength="100" class="box">
      </select>
      <input type="submit" value="add category" name="add_category" class="btn">
   </form>

</section>


<section class="show-category" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_category = $conn->prepare("SELECT * FROM `menu`");
      $show_category->execute();
      if($show_category->rowCount() > 0){
         while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <div class="name"><?= $fetch_category['catname']; ?></div>
      <div class="flex-btn">
         <a href="update_menu.php?update=<?= $fetch_category['catid']; ?>" class="option-btn">update</a>
         <a href="menu.php?delete=<?= $fetch_category['catid']; ?>" class="delete-btn" onclick="return confirm('delete this category?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no category added yet!</p>';
      }
   ?>

   </div>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html>