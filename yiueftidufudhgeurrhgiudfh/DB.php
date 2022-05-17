<?php
if(strpos($_SERVER['REQUEST_URI'],"DB.php")){
    require_once 'Utils.php';
    PlainDie();
}

$conn = new mysqli("localhost", "id16999486_def", "U48lKYr0CBq<W6|8", "id16999486_abc");
if($conn->connect_error != null){
    die($conn->connect_error);
}