<!DOCTYPE html>




<html lang="en-GB">



	<head>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title>XSS Reflected Based Demonstration</title>

	</head>
	
	
	<body class="home">
	
			
		<div id="container">

			<div class="header" id="header">
				<h1>Cross Site Scripting Demonstration</h1>
				<p>Reflected Based XSS</p>
			</div>

			<div id="main_body">

				<div class="body_padded">
	<h1>Vulnerability: Reflected Based Cross Site Scripting (XSS)</h1>

	<div class="Vulnerable_Function">
		<form name="XSS" action="#" method="GET">
			<p>
				What's your name?
				<input type="text" name="name">
				<input type="submit" value="Submit">
			</p>

		</form>
		
        <?php

		
		// Checking if there is an input
		if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {
			// Getting the input from the user and sanatizing it using htmlspecialchars
			$name = htmlspecialchars( $_GET[ 'name' ] );
		
			// Printing Hello + what came from the user input on the webpage
			echo "<pre>Hello ${name}</pre>";
		}
		
		?>
	</div>
	

</div>

			

	</body>

</html>