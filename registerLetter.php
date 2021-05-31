<?php
if ( isset($_POST["email"]) && isset($_POST["letter"]) && isset($_POST["year"]) && isset($_POST["month"]) && isset($_POST["day"]) ){
	
	addToDb($_POST["email"], $_POST["letter"], $_POST["year"] , $_POST["month"] , $_POST["day"] );

}
else{
	echo "failed0";
}


function addToDb($email,$letter, $year, $month, $day)
{
	$servername = "localhost";
	$username = "88843";
	$password = "bob123456";
	$dbname = "88843";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		//die("Connection failed: " . $conn->connect_error);
		echo "failed1";
		exit();
	}

    $conn->query("SET NAMES utf8mb4");

	$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.

	$sql = "INSERT INTO temp (hash,email, letter, year, month, day) VALUES ('$hash','$email','$letter', '$year', '$month', '$day')";
	
	if ($conn->query($sql) === TRUE) {
		
		// Send activation email
		
		$url= "http://lettertofuture" . rand(1,3) . ".000webhostapp.com/activateEmail.php?" . "email=" . $email . "&hash=" . $hash ;
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     

		
		echo "ok";
		
	} else {
		echo "failed2";
	}
	$conn->close();
}

?>