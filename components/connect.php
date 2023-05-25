
<?php 

$db_name = 'mysql:host=localhost;dbname=shopping_cart';
$db_user_name = 'root';
$db_user_pass = '';

$conn = new PDO($db_name,$db_user_name,$db_user_pass);


////////////////// create a random and unique id 
function create_unique_id(){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_length = strlen($characters);
    $random = '';

    for($i = 0; $i < 20; $i++){
        $random .= $characters[mt_rand(0,$characters_length - 1)];
    }

    return $random;

}

?>