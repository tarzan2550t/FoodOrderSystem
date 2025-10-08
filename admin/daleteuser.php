<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM customer WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:user.php');
}else{
    header('location:user.php'); 
}
}


?>