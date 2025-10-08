<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('UPDATE customer SET status = 1 WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:user.php');
}else{
    header('location:user.php'); 
}
}


?>