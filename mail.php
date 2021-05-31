<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php

if ( isset($_POST['to']) && isset($_POST['msg']) )
{
	$to = $_POST['to'];
	$body = $_POST['msg'] . "\n\n" . "« فرستاده شده با استفاده از اپلیکیشن نامه به آینده »" ;

	// send email
	$status = mail($to, "نامه ی شما به آینده تون!" , $body);
	
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