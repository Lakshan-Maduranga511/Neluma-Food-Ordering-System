<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit;
};

if (isset($_POST['update_offer'])) {

    $offer_id = $_POST['offer_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $end_date = $_POST['end_date'];

    $update_offer = $conn->prepare("UPDATE `offer` SET name = ?, description = ?, price = ?, end_date = ? WHERE offer_id = ?");
    $update_offer->execute([$name, $description, $price, $end_date, $offer_id]);

    $message[] = 'Offer updated!';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $update_image = $conn->prepare("UPDATE `offer` SET image = ? WHERE offer_id = ?");
            $update_image->execute([$image, $offer_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../uploaded_img/' . $old_image);
            $message[] = 'Image updated!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Offer</title>
    <link rel="shortcut icon" href="../images/head.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="update-offer">

    <h1 class="heading">Update Offer</h1>

    <?php
    $update_id = $_GET['update'];
    $show_offers = $conn->prepare("SELECT * FROM `offer` WHERE offer_id = ?");
    $show_offers->execute([$update_id]);
    if ($show_offers->rowCount() > 0) {
        while ($fetch_offers = $show_offers->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="offer_id" value="<?= $fetch_offers['offer_id']; ?>">
        <input type="hidden" name="old_image" value="<?= $fetch_offers['image']; ?>">
        <img src="../uploaded_img/<?= $fetch_offers['image']; ?>" alt="">
        <span>Update Name</span>
        <input type="text" required placeholder="Enter offer name" name="name" maxlength="100" class="box" value="<?= $fetch_offers['name']; ?>">
        <span>Update Description</span>
        <textarea name="description" class="box" required placeholder="Enter description" maxlength="500" cols="30" rows="10"><?= $fetch_offers['description']; ?></textarea>
        <span>Update Price</span>
        <input type="number" min="0" max="9999999999" required placeholder="Enter price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_offers['price']; ?>">
        <span>Update End Date</span>
        <input type="date" name="end_date" required placeholder="Valid till" class="box" value="<?= $fetch_offers['end_date']; ?>">
        <span>Update Image</span>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
        <div class="flex-btn">
            <input type="submit" value="Update Offer" class="btn" name="update_offer">
            <a href="offers.php" class="option-btn">Go Back</a>
        </div>
    </form>
    <?php
        }
    } else {
        echo '<p class="empty">No offers found!</p>';
    }
    ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>