<?php

include 'DB.php';
include 'Global.php';

if (!empty($_GET) ) {
    if (!empty($_GET['file']) && !empty($_GET['token']) && !empty($_GET['key'])) {
      if($maintenance == false){
         $key = $_GET['key'];
         $token = $_GET['token'];
         $file = "./asdasdasdadfsgsdrtergdff/".$_GET['file'];
         $fetch = "SELECT * FROM `tokens` WHERE `Username`='$key'";
         $fire = mysqli_query($conn,$fetch);
         if($fire){
            if(mysqli_num_rows($fire) == 1){
               $row=mysqli_fetch_assoc($fire);
               $dbtoken=$row['token'];
               if($dbtoken == $token){
                  if (file_exists($file)) {
                     header('Content-Description: File Transfer');
                     header('Content-Type: application/vnd.android.package-archive');
                     header('Content-Disposition: attachment; filename='.basename($file));
                     header('Content-Transfer-Encoding: binary');
                     header('Expires: 0');
                     header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                     header('Pragma: public');
                     header('Content-Length: ' . filesize($file));
                     ob_clean();
                     flush();
                     readfile($file);
                     exit;
                  }
               }
            }
         }
      }
   }
}