<?PHP
include 'DB.php';
include 'Global.php';

if (!empty($_GET) ) {
    if (!empty($_GET['key']) && !empty($_GET['uid'])) {
        if($maintenance == false){
            $uid = $_GET['uid'];
            $key = $_GET['key'];
            $fetch = "SELECT * FROM `tokens` WHERE `Username`='".$key."'";
            $fire = mysqli_query($conn,$fetch);
            if($fire){
            if(mysqli_num_rows($fire) == 1){
                $row=mysqli_fetch_assoc($fire);
                $Username=$row['Username'];
                $StartDate=$row['StartDate'];
                $EndDate=$row['EndDate'];
                $dbuid=$row['UID'];
                $Expiry=$row['Expiry'];
                $token=$row['token'];
                $uidvar = "0";
                $strToken = generateRandomString(30);

                if($row["StartDate"] == NULL){
                    
                    $query = $conn->query("UPDATE `tokens` SET `StartDate` = CURRENT_TIMESTAMP WHERE `Username` = '$Username'");
                }

                if($row["token"] == NULL){
                    $query = $conn->query("UPDATE `tokens` SET `token` = '$strToken' WHERE `Username` = '$Username'");
                }

                if($dbuid == NULL){
                    $fetch = "UPDATE `tokens` SET UID='$uid' WHERE `Username`='$key'";
                    $fire = mysqli_query($conn,$fetch);
                    if(date_diff(date_create($row["EndDate"]), (date("YYYY-MM-DD HH:MI:SS"))) < 1){
                        $data = array(
                            "code" => "0",
                             "msg" => "Please Try Again!"
                        );
                    } else{
                        $uidvar = "1";
                        $database = date_create($row["EndDate"]);
                        $datadehoje = date_create();
                        $resultado = date_diff($database, $datadehoje);
                        $days = date_interval_format($resultado, '%a');
                        $data = array(
                            "code"=>"1", 
                            "msg"=>"Successfully logged in!",
                            "Username"=>$Username,
                            "Valid"=>"$days",
                            "EndDate"=>"$EndDate",
                            "token"=>$token);
                    }
                }else if($dbuid == $uid){

                    if($row["EndDate"] < $row["StartDate"]){
                        $data = array(
                            "code" => "0",
                            "msg" => "Key Expired!"
                        );
                    } else{
                        $uidvar = "1";
                        $database = date_create($row["EndDate"]);
                        $datadehoje = date_create();
                        $resultado = date_diff($database, $datadehoje);
                        $days = date_interval_format($resultado, '%a');
                        $data = array(
                            "code"=>"1", 
                            "msg"=>"Successfully logged in!",
                            "Username"=>$Username,
                            "Valid"=>"$days",
                            "EndDate"=>"$EndDate",
                            "token"=>$token);
                    }
                } else{
                    $data = array("code"=>"0", 
                     "msg"=>"Device Mismatch!");
                }

                
            } else {
                $data = array("code"=>"0",
                "msg"=>"Key Invalid!"
                );
            }
            } else {
                $data = array("code"=>"0", 
                "msg"=>"Key Invalid!"
                );
            }
        }else {
                $data = array("code"=>"0", 
                "msg"=>"Server Under Maintenance!"
                );
            }
    }else{
        $data = array("code"=>"0", 
        "msg"=>"Fill in Key!"
        );
    }
}else{
        $data = array("code"=>"0", 
        "msg"=>"Fill in Key!"
        );
    }

    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

header('Content-Type: text/plain');
echo json_encode($data);