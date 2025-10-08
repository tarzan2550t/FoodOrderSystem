<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM product WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:food.php');
}else{
    header('location:food.php'); 
}
}


?>