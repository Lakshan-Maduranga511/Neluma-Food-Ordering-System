<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $pass = sha1($_POST['pass']);

   $select_rider = $conn->prepare("SELECT * FROM `rider` WHERE name = ? AND password = ?");
   $select_rider->execute([$name, $pass]);
   
   if($select_rider->rowCount() > 0){
      $fetch_rider_id = $select_rider->fetch(PDO::FETCH_ASSOC);
      $_SESSION['rider_id'] = $fetch_rider_id['id'];
      echo "<script> alert('Rider Login Successfully!!') </script>";
      echo "<script> window.location.href='rider_home.php';  </script>";
   }else{
      echo "<script> alert('Incorrect name or password!') </script>";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="shortcut icon" href="../images/head.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<section class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>





</body>
</html>