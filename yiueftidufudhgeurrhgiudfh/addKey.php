<?php
include 'DB.php';
include 'Global.php';


if (!empty($_GET) ) {
    if (!empty($_GET['key']) && !empty($_GET['endDate'])) {
        if($maintenance == false){

            $endDate = $_GET['endDate'];
            $newDate = date("YYYY-MM-DD HH:MI:SS", strtotime($endDate));
            $key = $_GET['key'];

        	$fetch = "SELECT * FROM `tokens` WHERE `Username`='.$key.'";
            $fire = mysqli_query($conn,$fetch);

            if($fire){
            	if(!mysqli_num_rows($fire) > 0){

            	$fetch = "INSERT INTO `tokens` (`Username`, `token`, `StartDate`, `EndDate`, `UID`, `Expiry`) VALUES ('$key', NULL, NULL, '$endDate', NULL, '2')";
            	$fire = mysqli_query($conn,$fetch);
            	$data = array("code"=>"1", "msg"=>"Key Entered Successfully");



            }else {
                $data = array("code"=>"0", "msg"=>"Key Already Exists!!");
            }
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