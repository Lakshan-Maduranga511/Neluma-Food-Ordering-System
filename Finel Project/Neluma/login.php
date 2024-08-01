<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login</title>
    <link rel="shortcut icon" href="images/head.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <section class="w3l-mockup-form">
        <div class="container">
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                    <a href="home.php"><span class="fa fa-close"></span></a>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/login2.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login</h2>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required="" oninput="this.value = this.value.replace(/\s/g, '')">
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required="">
                            &nbsp
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Don't have an account? <a href="register.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $password = sha1($_POST['password']);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $password]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      echo "<script> alert('User Login Successfully!!') </script>";
      echo "<script> window.location.href='home.php';  </script>";
   }else{
      echo "<script> alert('Incorrect username or password!') </script>";
   }

}

?>