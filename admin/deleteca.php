<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM category WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:ca.php');
}else{
    header('location:ca.php'); 
}
}


?>