<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="heading">
   <h3>Our Menu</h3>
   <p><a href="home.php">Home</a> <span> / Menu</span></p>
</div>

<section class="products">

   <?php

      $select_categories = $conn->prepare("SELECT * FROM `menu` WHERE catname != 'Special Offers'");
      $select_categories->execute();

      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){
            $catid = $fetch_categories['catid'];
            $catname = $fetch_categories['catname'];


            $select_products = $conn->prepare("SELECT * FROM `products` WHERE catid = ?");
            $select_products->execute([$catid]);

            if($select_products->rowCount() > 0){
            ?>

            <h1 class="title"><?= $catname; ?></h1>
            <div class="box-container">
            <?php
               while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
               <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
               <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
               <div class="name"><?= $fetch_products['name']; ?></div>
               <div class="flex">
                  <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
               </div>
            </form>
            <?php
               }
            ?>
            </div>

            <?php
            }
         }
      } else {
         echo '<p class="empty">No categories found!</p>';
      }
   ?>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>