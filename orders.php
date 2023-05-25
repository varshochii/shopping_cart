

<?php 

include './components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom css link -->
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    


<!------------------- header section  --------------------->
<?php include './components/header.php'; ?>






<!------------------- orders section start  --------------------->

<section class="orders">

    <h1 class="heading">my orders</h1>

    <div class="box-container">
    
        <?php 
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
            $select_orders->execute([$user_id]);

            if($select_orders->rowCount() > 0){

                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$fetch_orders['product_id']]);

                    if($select_products->rowCount() > 0){

                       while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                    
          ?>

            <a href="view_orders.php?get_id=<?= $fetch_orders['id']; ?>" class="box" <?php if($fetch_orders['status'] == 'cancelled'){echo 'style="border: 0.2rem solid var(--red);"';} ?>>
                 <p class="date"><i class="fas fa-calendar"></i> <?= $fetch_orders['date']; ?></p>
                 <img src="./uploaded_files/<?= $fetch_products['image']; ?>" alt="image" class="image">
                 <h3 class="name"><?= $fetch_products['name']; ?></h3>
                 <p class="price"><i class="fas fa-dollar"></i> <?= $fetch_orders['price']; ?> x <?= $fetch_orders['qty']; ?></p>
                 <p class="status" style="color:<?php if($fetch_orders['status'] == 'cancelled'){echo 'red';}elseif($fetch_orders['status'] == 'delivered'){echo 'green';}else{echo 'orange';} ?>"><?= $fetch_orders['status']; ?></p>
            </a>

        <?php 
            }
          }
                }

            }else{
        ?>

            <p class="empty">orders not found!</p>

        <?php 
            }
        ?> 

    </div>

</section>

<!------------------- orders section end  --------------------->







<!-- sweet alert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<!-- custom js file link -->
<script src="./js/script.js"></script>

<?php include './components/alert.php'; ?>

</body>
</html>