<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="title">quick view</h1>

   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            // Fetch category name based on catid
            $catid = $fetch_products['catid'];
            $get_category_name = $conn->prepare("SELECT catname FROM `menu` WHERE catid = ?");
            $get_category_name->execute([$catid]);
            $category_name = $get_category_name->fetchColumn();
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_products['id']); ?>">
      <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_products['name']); ?>">
      <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_products['price']); ?>">
      <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
      <img src="uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
      <!-- Display the fetched category name -->
      <a href="category.php?category=<?= htmlspecialchars($category_name); ?>" class="cat"><?= htmlspecialchars($category_name); ?></a>
      <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
      <div class="flex">
         <div class="price"><span>Rs.</span><?= htmlspecialchars($fetch_products['price']); ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
      <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>

<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>