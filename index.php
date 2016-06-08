<?php

// Grab necessary files and make new instance of the OpenVPN class
require("src/OpenVPN.class.php");
$vpn = new OpenVPN();

// User is trying to toggle VPN
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if ($vpn->started) {
		$success = $vpn->stop();
	} else {
		$success = $vpn->start();
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>RosenfeldVPN</title>
		<link rel="stylesheet" href="css/typebase.css">
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300|Cantata+One" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
	</head>
	<body>
		<header>
			<h1>VPN</h1>
		</header>
		<p>Status: <span class="label <?php echo ($vpn->started) ? 'success' : 'danger'; ?>"><?php echo ($vpn->started) ? 'started' : 'stopped'; ?></span></p>
		<?php $location = $vpn->ip(); ?>
		<p class="fine-print">You appear to be located in <?php echo $location["city"]; ?>, <?php echo $location["country"]; ?></p>
		<form method="post">
			<p>
				<button type="submit" class="btn <?php echo (!$vpn->started) ? 'success' : 'danger'; ?>"><?php echo (!$vpn->started) ? 'Start' : 'Stop'; ?> VPN</button>
			</p>
		</form>
	</body>
</html>
