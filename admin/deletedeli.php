<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM delivery WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:delivery.php');
}else{
    header('location:delivery.php'); 
}
}


?>