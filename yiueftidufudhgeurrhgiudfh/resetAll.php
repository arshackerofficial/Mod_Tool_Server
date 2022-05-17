<?php
include 'DB.php';
include 'Global.php';


if($maintenance == false){

    $fetch = "UPDATE `tokens` set `UID`= NULL";
    $fire = mysqli_query($conn,$fetch);
    $data = array("code"=>"1", "msg"=>"Server Reset Successfull!");
    }else {
        $data = array("code"=>"0", "msg"=>"Server Under Maintenance!");
        }

header('Content-Type: text/plain');
echo json_encode($data);