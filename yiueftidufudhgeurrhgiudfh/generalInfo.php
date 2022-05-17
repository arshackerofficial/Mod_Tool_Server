<?php
include 'DB.php';
include 'Global.php';


if($maintenance == false){

    $fetch = "SELECT(SELECT COUNT(*) FROM `tokens` ) AS `Total_Keys`, (SELECT COUNT(*) FROM `tokens` WHERE UID IS NOT NULL ) AS `Total_Active_Keys`";
    $fire = mysqli_query($conn,$fetch);
    if($fire){
    $row = mysqli_fetch_array($fire);
    $totalKeys = $row['Total_Keys'];
    $totalActiveKeys = $row['Total_Active_Keys'];
    $data = array("code"=>"1", "msg"=>"Data Sent!", "totalActiveKeys"=>"$totalActiveKeys", "totalKeys"=>"$totalKeys" );
}else {
        $data = array("code"=>"0", "msg"=>"Failed!");
        }
    }else {
        $data = array("code"=>"0", "msg"=>"Server Under Maintenance!");
        }

header('Content-Type: text/plain');
echo json_encode($data);


