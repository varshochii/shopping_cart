

<?php 

include './components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}


/////////////////////////////////////////////////////
////// check for get_id 
if(isset($_GET['get_id'])){

    $get_id = $_GET['get_id'];

}else{
    
    $get_id = '';
    header("Location: orders.php");
}


/////////////////////////////////////////////////////
////// cancel order process

if(isset($_POST['cancel'])){

     $update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
     $update_order->execute(['cancelled',$get_id]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ordes</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom css link -->
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    


<!------------------- header section  --------------------->
<?php include './components/header.php'; ?>




<!------------------- view order section start  --------------------->


<section class="view-order">

    <h1 class="heading">order details</h1>


        <?php 

             $grand_total = 0;

            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
            $select_orders->execute([$get_id]);

            if($select_orders->rowCount() > 0){

                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){

                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$fetch_orders['product_id']]);

                    if($select_products->rowCount() > 0){

                       while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                        $sub_total = $fetch_orders['price'] * $fetch_orders['qty'];

                        $grand_total += $sub_total;

          ?>

            <div class="row">
                <div class="col">
                      <p class="title"><i class="fas fa-calendar"></i> <?= $fetch_orders['date']; ?></p>
                      <img src="./uploaded_files/<?= $fetch_products['image']; ?>" alt="image" class="image">
                      <h3 class="name"><?= $fetch_products['name']; ?></h3>
                      <p class="price"><i class="fas fa-dollar"></i> <?= $fetch_orders['price']; ?> x <?= $fetch_orders['qty']; ?></p>
                      <p class="grand_total">grand total : <span><i class="fas fa-dollar"></i> <?= $grand_total; ?></span></p>
                </div>
                <div class="col">
                     <p class="title">billing address</p>
                     <p class="user"><i class="fas fa-user"></i> <?= $fetch_orders['name']; ?></p>
                     <p class="user"><i class="fas fa-phone"></i> <?= $fetch_orders['number']; ?></p>
                     <p class="user"><i class="fas fa-envelope"></i> <?= $fetch_orders['email']; ?></p>
                     <p class="user"><i class="fas fa-map-marker-alt"></i> <?= $fetch_orders['address']; ?></p>
                     <p class="title">status</p>
                     <p class="status" style="color:<?php if($fetch_orders['status'] == 'cancelled'){echo 'red';}elseif($fetch_orders['status'] == 'delivered'){echo 'green';}else{echo 'orange';} ?>"><?= $fetch_orders['status']; ?></p>
                     <?php if($fetch_orders['status'] == 'cancelled'): ?>
                         <a href="checkout.php?get_id=<?= $fetch_orders['product_id']; ?>" class="btn">order again</a>
                     <?php else: ?>
                         <form action="" method="POST">
                               <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('cancel this order?');">
                         </form>
                     <?php endif; ?>
                </div>
            </div>


    <?php 
            }
          }else{
    ?>
           <p class="empty">product not found!</p>
    <?php 
          }
                }

            }else{
        ?>

            <p class="empty">order was not found!</p>

        <?php 
            }
        ?> 

</section>


<!------------------- view order section ends  ---------------------->










<!-- sweet alert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<!-- custom js file link -->
<script src="./js/script.js"></script>

<?php include './components/alert.php'; ?>

</body>
</html>