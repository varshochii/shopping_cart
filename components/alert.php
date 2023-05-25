

<?php 
if(isset($success_msg)){
    
     foreach($success_msg as $success_msg){
?>
    <script>swal("<?= $success_msg; ?>","","success");</script>
<?php 
     }
}
?>



<?php 
if(isset($warning_msg)){
    
     foreach($warning_msg as $warning_msg){
?>
    <script>swal("<?= $warning_msg; ?>","","warning");</script>
<?php 
     }
}
?>


<?php 
if(isset($error_msg)){
    
     foreach($error_msg as $error_msg){
?>
    <script>swal("<?= $error_msg; ?>","","error");</script>
<?php 
     }
}
?>


<?php 
if(isset($info_msg)){
    
     foreach($info_msg as $info_msg){
?>
    <script>swal("<?= $info_msg; ?>","","info");</script>
<?php 
     }
}
?>


