
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Register</title>
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
                            <img src="images/login1.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register</h2>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name" required="" >
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" oninput="this.value = this.value.replace(/\s/g, '')" required="">
                            <input type="number" class="number" name="number" placeholder="Enter Your Phone Number" min="0" max="9999999999" maxlength="10" required="">
                            <input type="password" class="password" name="pass" placeholder="Enter Your Password" required="">
                            <input type="password" class="confirm-password" name="cpass" placeholder="Enter Your Confirm Password" required="">
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account? <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </section>

</body>

</html>

<?php

include('components/connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $email = $number = $password = $confirm_password = "";
    

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $number = trim($_POST["number"]);
    $password = trim($_POST["pass"]);
    $confirm_password = trim($_POST["cpass"]);


    if (empty($name) || empty($email) || empty($number) || empty($password) || empty($confirm_password)) {

        echo "<script> alert('Please fill all fields.') </script>";
    } elseif ($password != $confirm_password) {

        echo "<script> alert('Password and Confirm Password do not match.') </script>";
    } else {

        if ($conn) {
 
            $sql = "SELECT id FROM users WHERE email = :email";
            

            $stmt = $conn->prepare($sql);
            if ($stmt) {

                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                

                if ($stmt->execute()) {

                    if ($stmt->rowCount() == 1) {
                        echo "<script> alert('This email is already registered.') </script>";
                    } else {
 
                        $sql = "INSERT INTO users (name, email, number, password) VALUES (:name, :email, :number, :password)";
                        

                        $stmt = $conn->prepare($sql);
                        if ($stmt) {

                            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                            $stmt->bindParam(":number", $number, PDO::PARAM_STR);
                            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
                            

                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            

                            if ($stmt->execute()) {
                                echo "<script> alert('User Register Successfully!!') </script>";
                                echo "<script> window.location.href='login.php';  </script>";
                                exit();
                            } else {
                                echo "<script> alert('Something went wrong. Please try again later.') </script>";
                            }
                        } else {
                            echo "<script> alert('Error: Failed to prepare SQL statement.') </script>";
                        }
                    }
                } else {
                    echo "<script> alert('Error: Unable to execute SQL statement.') </script>";
                }
            } else {
                echo "<script> alert('Error: Failed to prepare SQL statement.') </script>";
            }
        } else {
            echo "<script> alert('Error: Database connection failed.') </script>";
        }
    }


    $conn = null;
}
?>