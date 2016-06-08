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
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300|Cantata+One" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-icon" sizes="57x57" href="/RosenfeldVPN/icons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/RosenfeldVPN/icons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/RosenfeldVPN/icons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/RosenfeldVPN/icons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/RosenfeldVPN/icons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/RosenfeldVPN/icons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/RosenfeldVPN/icons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/RosenfeldVPN/icons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/RosenfeldVPN/icons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/RosenfeldVPN/icons/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/RosenfeldVPN/icons/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/RosenfeldVPN/icons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/RosenfeldVPN/icons/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/RosenfeldVPN/icons/manifest.json">
		<link rel="mask-icon" href="/RosenfeldVPN/icons/safari-pinned-tab.svg" color="#501616">
		<link rel="shortcut icon" href="/RosenfeldVPN/icons/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="rVPN">
		<meta name="application-name" content="rVPN">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/RosenfeldVPN/icons/mstile-144x144.png">
		<meta name="msapplication-config" content="/RosenfeldVPN/icons/browserconfig.xml">
		<meta name="theme-color" content="#501616">
	</head>
	<body>
		<header>
			<h1>VPN</h1>
		</header>
		<p>Status: <span class="label <?php echo ($vpn->started) ? 'success' : 'danger'; ?>"><?php echo ($vpn->started) ? 'started' : 'stopped'; ?></span></p>
		<p class="fine-print"><?php echo $vpn->ip()->Answer; ?></p>
		<form method="post">
			<p>
				<button type="submit" class="btn <?php echo (!$vpn->started) ? 'success' : 'danger'; ?>"><?php echo (!$vpn->started) ? 'Start' : 'Stop'; ?> VPN</button>
			</p>
		</form>
	</body>
</html>
