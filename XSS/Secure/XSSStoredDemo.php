<!DOCTYPE html>




<html lang="en-GB">



	<head>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		
		<title>XSS Stored Based Demonstration</title>

	</head>
	
	
	<body class="home">
	
			
		<div id="container">

			<div class="header" id="header">
				<h1>Cross Site Scripting Demonstration</h1>
				<p>Stored Based XSS</p>
			</div>

			<div id="main_body">


	<div class="body_padded">
	<h1>Vulnerability: Stored Cross Site Scripting (XSS)</h1>

	<div class="Vulnerable_Function">
		<form method="post" name="guestform" ">
			<table width="550" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="100">Name *</td>
					<td><input name="txtName" type="text" size="30" maxlength="10"></td>
				</tr>
				<tr>
					<td width="100">Message *</td>
					<td><textarea name="mtxMessage" cols="50" rows="3" maxlength="50"></textarea></td>
				</tr>
				<tr>
					<td width="100">&nbsp;</td>
					<td>
						<input name="btnSign" type="submit" value="Sign Guestbook" onclick="return validateGuestbookForm(this.form);" />
						
					</td>
				</tr>
			</table>
<?php


if( isset( $_POST[ 'btnSign' ] ) ) {
	//Setting Variables
	$message = "";
	$name = "";
	//Parsing config file
	$ini = parse_ini_file('app.ini.php');
//Connecting to the DB
$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect($ini['db_name'], $ini['db_user'],  $ini['db_password'], $ini['db_database'], $ini['db_port'])) or die ('Cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
	

	// Ensuring Connection has been established
	if ($conn -> connect_errno) {
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
	exit();
	}
	
	
   // Get input
    $message = trim( $_POST[ 'mtxMessage' ] );
    $name    = trim( $_POST[ 'txtName' ] );

    // Sanitize message input
    $message = stripslashes( $message );
    $message = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $message ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
    $message = htmlspecialchars( $message );
	
	// Sanitize name input
	$name = stripslashes( $name );
    $name = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $name ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
    $name = htmlspecialchars( $name );
	
	//Setting the query and committing the name and comment to the database.
	$query  = "INSERT INTO xssdemo ( comment, name ) VALUES ( '$message', '$name' );";
    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );

    
}

?>
		
	
	</form>

</div>
	
<br />
	

<?php
//Importing the configuration file and parsing it into the $ini array to use for DB connection
$ini = parse_ini_file('app.ini.php');

$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect($ini['db_name'], $ini['db_user'],  $ini['db_password'], $ini['db_database'], $ini['db_port'])) or die ('Cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

	// XSS DVWA guestbook function from DVWA and used and modified under the GNU Public Software License
function xssdemofunc() {
	$querytwo  = "SELECT name, comment FROM xssdemo ORDER BY comment_id DESC LIMIT 1";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $querytwo );

	$guestbook = '';

		while( $row = mysqli_fetch_row( $result ) ) {
			$name    = $row[0];
			$comment = $row[1];
			echo $name;
			echo $comment;
		}
	
		$guestbook .= "<div id=\"guestbook_comments\">Name: {$name}<br />" . "Message: {$comment}<br /></div>\n";
	
	return $guestbook;
}
// -- End of procedure

//Calling the above procedure
xssdemofunc();

?>



<br />

</div>

			

	</body>

</html>