<?php

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$text = $_POST['text'];

	$myfile = fopen($name, "w") or die("Unable to open file!");
	fwrite($myfile, $text);
	fclose($myfile);

	// connect and login to FTP server
	$ftp_server = 'FTP SERVER'; //FTP SERVER
	$ftp_username = 'FTP_USERNAME'; //FTP USERNAME
	$ftp_userpass = 'FTP_PASSWORD'; //FTP PASSWORD
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
	$file = $name;

	// upload file
	if (ftp_put($ftp_conn, $name, $file, FTP_ASCII)){
	  	echo "Successfully uploaded $file.";
	}else{
	  	echo "Error uploading $file.";
	}

	//Close FTP Connection
	ftp_close($ftp_conn);	
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>

<form method="POST" action="">
	<label>File Name : </label><br />
	<input type="text" name="name"><br />
	<label>Text : </label><br />
	<input type="text" name="text"><br />
	<button type="submit" name="submit">Save</button>
</form>


</body>
</html>
