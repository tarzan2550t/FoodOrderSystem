<?php
include '../db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    
    $stmt = $conn->prepare('UPDATE `order` SET travelstatus = 8 , status = 7  WHERE id = ?');
    $up1 = $stmt->execute([$id]);


    $stmt = $conn->prepare('UPDATE order_item SET status = 8 WHERE order_id = ?');
    $up2 = $stmt->execute([$id]);

    
    if($up1 && $up2){
        header('location:status.php');
    } else {

        header('location:status.php'); 
    }
}
?>