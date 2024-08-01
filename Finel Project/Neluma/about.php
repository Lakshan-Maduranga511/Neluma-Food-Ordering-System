<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>


<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/bgpic.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Welcome to Neluma, Sri Lanka's premier food delivery service! At Neluma, we cater to all your culinary needs,
             whether you're craving a quick snack, planning a family meal, or organizing a large catering event. 
             Our diverse range of dining options, from gourmet restaurants to cozy local eateries, 
             ensures you'll find the perfect meal to suit your tastes and budget. 
             Our dedicated team of food enthusiasts offers personalized recommendations and local insights, 
             enhancing your dining experience. With our reliable delivery service, enjoy your meals conveniently and promptly.
              Discover the essence of Sri Lanka's vibrant food culture with Neluma today!</p>
         <a href="menu.php" class="btn">our menu</a>
      </div>

   </div>

</section>


<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Browse through our extensive menu to find the perfect meal. 
            Whether you're in the mood for a gourmet experience or a local favorite, we've got something for <br>everyone.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Once you've placed your order, our efficient bike delivery team ensures your food arrives quickly and in perfect condition, 
            bringing delicious meals right to your <br>doorstep.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Sit back and savor your delicious meal, delivered right to your door. With Neluma, 
            enjoying the best of Sri Lanka's culinary delights has never been easier or more convenient.</p>
      </div>

   </div>

</section>



<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>