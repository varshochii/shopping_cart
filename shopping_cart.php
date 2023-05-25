

<?php 

include './components/connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}



/////////////////////////////////////////////////////
////////// update cart process 
if(isset($_POST['update_cart'])){

     $cart_id = $_POST['cart_id'];
     $cart_id = filter_var($cart_id,FILTER_SANITIZE_SPECIAL_CHARS);

     $qty = $_POST['qty'];
     $qty = filter_var($qty,FILTER_SANITIZE_SPECIAL_CHARS);

     $update_cart = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
     $update_cart->execute([$qty,$cart_id]);

     $success_msg[] = 'Cart quantity updated!';
}



/////////////////////////////////////////////////////
////////// delete item process

if(isset($_POST['delete_item'])){

    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id,FILTER_SANITIZE_SPECIAL_CHARS);

    $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
    $verify_delete_item->execute([$cart_id]);

    if($verify_delete_item->rowCount() > 0){

        $delete_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_item->execute([$cart_id]);

        $success_msg[] = 'Cart item removed!';

    }else{
        $warning_msg[] = 'Cart item already deleted!';
    }
}


/////////////////////////////////////////////////////
////////// empty whole cart process
if(isset($_POST['empty_cart'])){

    $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_empty_cart->execute([$user_id]);

    if($verify_empty_cart->rowCount() > 0){

        $delete_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_item->execute([$user_id]);

        $success_msg[] = 'All items are removed from your cart!';

    }else{
        $warning_msg[] = 'Already removed from cart!';
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom css link -->
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    


<!------------------- header section  --------------------->
<?php include './components/header.php'; ?>



<!------------------- shopping section starts  --------------------->

<section class="products">

<h1 class="heading">shopping cart</h1>

<div class="box-container">

  <?php 

     $grand_total = 0;

     $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
     $select_cart->execute([$user_id]); 

     if($select_cart->rowCount() > 0){

         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){

            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_cart['product_id']]);

            if($select_products->rowCount() > 0){

                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){     
      ?>


     <form action="" method="POST" class="box">
           <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
           <img src="./uploaded_files/<?= $fetch_products['image']; ?>" class="image" alt="">
           <h3 class="name"><?= $fetch_products['name']; ?></h3>
           <div class="flex">
               <p class="price"><i class="fas fa-dollar"></i> <?= $fetch_products['price']; ?></p>
               <input type="number" name='qty' maxlength="2" min="1" value="<?= $fetch_cart['qty']; ?>" max="99" class="qty" required>
               <button type="submit" class="fas fa-edit" name="update_cart"></button>
            </div>
            <p class="sub-total">sub total: <span><i class="fas fa-dollar"></i> <?= $sub_total = ($fetch_products['price'] * $fetch_cart['qty']); ?></span></p>
            <input type="submit" value="delete item" class="delete-btn" name="delete_item" onclick="return confirm('delete this item?')">
     </form>

      
  <?php 

    $grand_total += $sub_total;

    }

 }else{

    ?>

<p class="empty">no products found!</p>

<?php 

  }
         }
     }else{

    ?>

       <p class="empty">shopping cart is empty!</p>

   <?php 
        
       }

    ?>



</div>

<?php if($grand_total != 0): ?>
   <div class="grand-total">
       <p>grand total : <span><i class="fas fa-dollar"></i> <?= $grand_total; ?></span></p>
       <a href="checkout.php" class="btn">proceed to checkout</a>
       <form action="" method="POST">
            <input type="submit" value="empty cart" name="empty_cart" class="delete-btn" onclick="return confirm('empty your cart?');">
       </form>
   </div>
<?php endif; ?>

</section>

<!------------------- shopping section ends  --------------------->






<!-- sweet alert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<!-- custom js file link -->
<script src="./js/script.js"></script>

<?php include './components/alert.php'; ?>

</body>
</html>