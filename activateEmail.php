<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php

if ( isset($_GET['email']) && isset($_GET['hash']) )
{

	$hash=$_GET['hash'];
	$to = $_GET['email'];
	
	$body = "برای فعالسازی ایمیل و ثبت نامه ی خود، روی لینک زیر کلیک کنید:" . "\n\n" .
	"http://www.lettertofuture.coolpage.biz/verify.php?email=$to&hash=$hash" ;

	// send email
	$status = mail($to, "( نامه به آینده ) فعالسازی ایمیل" , $body);
	
	if ($status){
		echo "ok";
	}else{
		echo "failed";
	}
}
else{
	echo "failed";
}


?> 