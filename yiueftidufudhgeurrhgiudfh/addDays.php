<?php
include 'DB.php';
include 'Global.php';


if (!empty($_GET) ) {
    if (!empty($_GET['key']) && !empty($_GET['days'])) {
        if($maintenance == false){

            $days = $_GET['days'];
            $key = $_GET['key'];

        	$fetch = "SELECT * FROM `tokens` WHERE `Username`='$key'";
            $fire = mysqli_query($conn,$fetch);

            if($fire){
            	if(mysqli_num_rows($fire) == 1){
                    $dbdata = mysqli_fetch_array($fire);
                    $dbdate = $dbdata['EndDate'];
                    $mod_date = strtotime($dbdate."+ $days days");
                    $add_days = date("Y/m/d h:m",$mod_date);
                    $conn->query("UPDATE tokens SET EndDate='$add_days' WHERE `Username` = '$key'");

            	    $data = array("code"=>"1", "msg"=>"$days Days Added!!");



                }else {
                    $data = array("code"=>"0", "msg"=>"Key Doesn't Exists!!");
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