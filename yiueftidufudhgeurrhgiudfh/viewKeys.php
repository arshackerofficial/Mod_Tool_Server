<?php
include 'DB.php';
include 'Global.php';
    $fetch = "SELECT `Username` FROM `tokens`";
    $fire = mysqli_query($conn,$fetch);
	$rowcount=mysqli_num_rows($fire);
	for ($i=0; $i < $rowcount ; $i++) { 
		$row = mysqli_fetch_array($fire);
		echo $row['Username'];
		if (($i + 1) != $rowcount) {
			echo ",";
		}
	}
?>