<?php
include 'DB.php';
include 'Global.php';


if (!empty($_GET) ) {
    if (!empty($_GET['key'])) {
        if($maintenance == false){
            $key = $_GET['key'];

        	$fetch = "SELECT * FROM `tokens` WHERE `Username`='$key'";
            $fire = mysqli_query($conn,$fetch);

            if($fire){
                $conn->query("DELETE FROM `tokens` WHERE `Username`='$key'");
        	    $data = array("code"=>"1", "msg"=>"$key Deleted!!");
            }else {
                $data = array("code"=>"0", "msg"=>"Key Doesn't Exists!!");
            }
        }else {
                $data = array("code"=>"0", "msg"=>"Server Under Maintenance!");
            }
    }else{
        $data = array("code"=>"0", "msg"=>"Fill in Key!");
    }
}else{
        $data = array("code"=>"0", "msg"=>"Fill in Key!");
    }

header('Content-Type: text/plain');
echo json_encode($data);