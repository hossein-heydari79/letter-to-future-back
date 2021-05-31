<?php

if ( isset($_GET['email']) && isset($_GET['hash']) )
{
    $email = $_GET['email'];
    $hash = $_GET['hash'];
	
	mysql_connect("localhost", "88843", "bob123456") or die(mysql_error()); // Connect to database server(localhost) with username and password.
	mysql_select_db("88843") or die(mysql_error()); // Select registrations database.
	

	$search = mysql_query("SELECT id, date_added, hash, email, letter, year, month, day FROM temp WHERE email='$email' AND hash='$hash'") or die(mysql_error()); 
	$match  = mysql_num_rows($search);
	
	if($match > 0){
		// We have a match, activate the account
		$row = mysql_fetch_row($search);

		mysql_query("SET NAMES utf8mb4");
		
		$letter = $row[4];
		$year = $row[5];
		$month = $row[6];
		$day = $row[7];
		
		mysql_query("INSERT INTO to_be_lettered (email, letter, year, month, day) VALUES ('$email','$letter', '$year', '$month', '$day')");
		
		mysql_query("DELETE FROM `temp` WHERE `hash` = '$hash'");
		
		header('Location: /verified-ok.html');
		
	}
	else{
		echo "failed";
	}

}
else{
	echo "failed";
}

?> 