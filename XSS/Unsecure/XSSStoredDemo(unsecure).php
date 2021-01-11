<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="GuestBook.js"></script>
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
					<td width="100">note *</td>
					<td><textarea name="mtxnote" cols="50" rows="3" maxlength="50"></textarea></td>
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
$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost",  "root",  "mysqlpassword", "web", "3306")) or die ('Cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
	// Check connection
	if ($conn -> connect_errno) {
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
	exit();
	}
   // Get input
    $note = trim( $_POST[ 'mtxnote' ] );
    $name    = trim( $_POST[ 'txtName' ] );
    // Sanitize note input
    $note = stripslashes( $note );
	$note = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $note ) : ((trigger_error("[MySQLConverterToo] Error due to mysql_escape_string() fix and redploy this code!", E_USER_ERROR)) ? "" : ""));
	
	// Sanitize name input
    $name = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $name ) : ((trigger_error("[MySQLConverterToo] Error due to mysql_escape_string() fix and redploy this code!", E_USER_ERROR)) ? "" : ""));    
	
	$query = ("INSERT INTO guestbook ( comment, name ) VALUES ( '$note', '$name' );");
    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
   
    //mysql_close();
}
?>
		
	</form>
</div>
<br />
	<div id="guestbook_comments">Name: test<br />note: This is a test comment.<br /></div>
<?php
$conn=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost",  "root",  "mysqlpassword", "web", "3306")) or die ('Cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
	// XSS Stored guestbook function -- 
function Guestbook() {
	$querytwo  = "SELECT name, comment FROM guestbook ORDER BY comment_id DESC LIMIT 1";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $querytwo );
	$guestbook = '';
		while( $row = mysqli_fetch_row( $result ) ) {
			$name    = $row[0];
			$comment = $row[1];
			echo $name;
			echo $comment;
		}
		$guestbook .= "<div id=\"guestbook_comments\">Name: {$name}<br />" . "note: {$comment}<br /></div>\n";
	return $guestbook;
}
// -- END (XSS Stored guestbook)	 
GuestBook();
?>

<br />
</div>			
	</body>

</html>
