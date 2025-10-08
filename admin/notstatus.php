<?php
include '../db.php';
if(isset($_GET['id'])){
$id = $_GET['id'];
$stmt = $conn->prepare('UPDATE restaurant SET status = 2 WHERE id = ?');
$up = $stmt->execute([$id]);
if($up){
  header('location:res.php');
}else{
    header('location:res.php'); 
}
}


?>