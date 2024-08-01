<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
   exit;
};

if(isset($_POST['submit'])){

   $address = $_POST['house'] .', '.$_POST['street'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['district'] .', '. $_POST['province'] .' - '. $_POST['postal_code'];

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   echo "<script> alert('address saved!') </script>";
   echo "<script> window.location.href='checkout.php';  </script>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update address</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>your address</h3>
      <input type="text" class="box" placeholder="house no." required maxlength="50" name="house">
      <input type="text" class="box" placeholder="street name" required maxlength="50" name="street">
      <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="town name" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="district name" required maxlength="50" name="district">
      <input type="text" class="box" placeholder="province name" required maxlength="50" name="province">
      <input type="number" class="box" placeholder="postal code" required max="999999" min="0" maxlength="6" name="postal_code">
      <input type="submit" value="save address" name="submit" class="btn">
   </form>

</section>



<?php include 'components/footer.php' ?>



<script src="js/script.js"></script>

</body>
</html>