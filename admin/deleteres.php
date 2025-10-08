<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM restaurant WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:res.php');
}else{
    header('location:res.php'); 
}
}


?>