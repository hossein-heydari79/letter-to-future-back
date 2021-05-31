<?php
     
$cYear= (int) date('yy');	
$cMonth= (int) date('m');	 
$cDay= (int) date('d');

$servername = "localhost";
$username = "88843";
$password = "bob123456";
$dbname = "88843";
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {

	echo "failed0";
	json_encode($obj);
		
	exit();
}

//Build SQL String
$sqlString ="SELECT id, email, letter, year, month, day FROM to_be_lettered WHERE year='$cYear' AND month='$cMonth' AND day='$cDay'";

//Execute the query and put data into a result
$result = $conn->query($sqlString);


//Copy result into a numeric array
$resultArray = $result->fetch_all(MYSQLI_NUM);

foreach($resultArray as $v)
{
	$email=$v[1];
	$letter=$v[2];	
		
	$fields = array(
	'to' => $email,
	'msg' => $letter);

	$fields_string ="";

	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	$url= "http://lettertofuture" . rand(1,3) . ".000webhostapp.com/mail.php";

	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = curl_exec($ch);
	
	if (strpos($result, 'ok'))
	{
		$sql0 = "INSERT INTO lettered ( email, letter, year, month, day) VALUES ('$email','$letter', '$cYear', '$cMonth', '$cDay')";
		$sql1= "DELETE FROM `to_be_lettered` WHERE	`email` = '$email' AND 	`letter` = '$letter' AND `year` = '$cYear' AND `month` = '$cMonth' AND `day` = '$cDay'";
		$conn->query($sql0);
		$conn->query($sql1);
		
		echo "ok [" . $v[1] . "]";
	}
	
	//close connection
	curl_close($ch);
}

if(sizeof($resultArray) ==0){
		echo "no_matches";
}

$conn->close();

?>