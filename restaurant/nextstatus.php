<?php
include '../db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    
    $stmt = $conn->prepare('UPDATE `order` SET travelstatus = 4 WHERE id = ?');
    $up1 = $stmt->execute([$id]);


    $stmt = $conn->prepare('UPDATE order_item SET status = 4 WHERE order_id = ?');
    $up2 = $stmt->execute([$id]);

    
    if($up1 && $up2){
        header('location:status.php?id='.$id.'');
    } else {

       header('location:order.php'); 
    }
}
?>