<?php
function forma() {
	echo"<form id=\"UID\" method=\"get\">";
	echo"	<font size=\"6\">UID Amiibo: <input id=\"UID\" name=\"UID\" type=\"text\" maxlength=14";
	if (isset($_GET['UID'])) {
		echo " value=\"".$_GET['UID']."\"";
	}
	echo" size=\"10\"></font>";
	echo"	<input type=\"submit\" value=\"Invia\" name=\"site\"/>";
	echo"</form>";
	echo"<br>";
}
function fondo() {
	echo"<br><br><br><br>";
	echo"Script Realizzato da <a href=\"https://www.i2cttl.com\">RyujiAndy</a>, grazie all'algoritmo di <a href=\"https://www.reboot.ms/forum/members/student.1250/\">student</a><br>";
	echo"<a href=\"https://www.reboot.ms/forum/articles/\">Reboot.ms</a> &#169;2014-2015 <a href=\"https://git.i2cttl.com/ryujiandy/amiibo_pass\">Source Script</a>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
<head> 
		
	<title>Amiibo Generate Key</title>
		


</head>
<body<?php if (isset($_GET['site']) || (!isset($_GET['site']) && !isset($_GET['UID']))) { echo" bgcolor=\"00979c\""; } ?>>
<div align="center">
	<?php
	if (isset($_GET['site']) || (!isset($_GET['site']) && !isset($_GET['UID']))) { 
		echo"<img src=\"http://www.reboot.ms/forum/styles/arduinoux/arduinoux/logo.png\">";
		echo"<br><br><br>";
	}
	if (isset($_GET['UID'])) {
		$script = "./amiibo_pass ".$_GET['UID'];
		$output = shell_exec($script);
		if(isset($_GET['site'])) {
			forma();
			if(strstr($output, "missing UID")) {
				echo "Inserire UID dell'amibo";
			} else if (strstr($output, "UID too long")) {
				echo "UID inserito troppo lungo";
			} else if (strstr($output, "Invalid character UID")) {
				echo"Carattere non valido";
			} else if (strstr($output, "UID not valid")) {
				echo"UID inserito non valido";
			} else if (strstr($output, "Password")) {
				$pin0 = strtoupper(substr($output, 34, 2)); 
				$pin1 = strtoupper(substr($output, 37, 2)); 
				$pin2 = strtoupper(substr($output, 40, 2));
				$pin3 = strtoupper(substr($output, 43, 2));
				echo "Password NFC Amiibo = ".$pin0." : ".$pin1." : ".$pin2." : ".$pin3;
			} else {
				echo "<pre>$output</pre>";
			}	
			fondo();			
		} else {
			echo "<pre>$output</pre>";
		}
	} else {
		forma();
		fondo();
	}
	?>
	
</div>
</body>
</html>
