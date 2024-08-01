<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../components/connect.php';

if (!isset($_SESSION['rider_id'])) {
    header('Location: login.php');
    exit();
}

$rider_id = $_SESSION['rider_id'];

if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Add your CSS styles here */
        .profile {
            display: none;
        }
        .profile.active {
            display: block;
        }
    </style>
</head>
<body>

<header class="header">

   <section class="flex">

      <a href="rider_home.php" class="logo">Rider<span>Panel</span></a>

      <nav class="navbar">
         <a href="rider_home.php">home</a>
         <a href="update_tracking.php">update tracking</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `rider` WHERE id = ?");
            $select_profile->execute([$rider_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
          <p><?= $fetch_profile['name']; ?></p>
         <a href="../components/rider_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>

<script>
$(document).ready(function(){
    $('#user-btn').on('click', function(){
        $('.profile').toggleClass('active');
    });
});
</script>

</body>
</html>