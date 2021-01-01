<!DOCTYPE html>

<html lang="en-GB">
<head>
		<link rel="stylesheet" type="text/css" href="main.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title>XSS Dom Based Demonstration</title>

	</head>

	<body class="home">
		<div id="container">

			<div class="header" id="header">
				<h1>Cross Site Scripting Demonstration</h1>
				<p>Dom Based XSS</p>
			</div>
			<div id="main_body">
				<div class="body_padded">
	<h1>Vulnerability: DOM Based Cross Site Scripting (XSS)</h1>
		<div class="Vulnerable_Function">
	<p>Please choose a language:</p>
		<form name="XSS" method="GET">
			<select name="default"  >
				<script>
					if (document.location.href.indexOf("default=") >= 0) {
						var lang = document.location.href.substring(document.location.href.indexOf("default=")+8);
						document.write("<option value='" + lang + "'>" + decodeURI(lang) + "</option>");
						document.write("<option value='' disabled='disabled'>----</option>");
					}
					    
					document.write("<option value='Hindi'>Hindi</option>");
					document.write("<option value='Telugu'>Telugu</option>");
					document.write("<option value='English'>English</option>");
					document.write("<option value='Marathi'>Marathi</option>");
					</script>
			</select>
			<input type="submit" value="Select" />
		</form>
	</div>
	</body>
</html>
