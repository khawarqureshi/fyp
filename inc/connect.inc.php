<?php 
	$conn = mysqli_connect("localhost","root","") or die("Couldn't connet to SQL server");
	mysqli_select_db($conn, "online_pharmacy") or die("Couldn't select DB");
?>