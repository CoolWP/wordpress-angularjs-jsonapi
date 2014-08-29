<?php 

require_once("wp-config.php");

# url for the web site this script is running under
$serverPort = "";
if ($_SERVER['SERVER_PORT'] != "80") {
  $serverPort = ":{$_SERVER['SERVER_PORT']}";
}
$newServerUrl = "http://{$_SERVER["SERVER_NAME"]}{$serverPort}";

# connect to the database with the wordpress site credentials
list($host, $port) = explode(":", DB_HOST);

$con = new mysqli($host, DB_USER, DB_PASSWORD, DB_NAME, $port);
if (mysqli_connect_error()) {
	printf("Connect failed: %s", mysqli_connect_error());
	exit();
}

# update the word press options for site url and home page
if ($stmt = $con->prepare("update `wp_options` set `option_value` = ? where `option_name` in ('siteurl','home')")) {
	
	$stmt->bind_param('s', $newServerUrl);
	$stmt->execute();
	$stmt->close();
	
} else {

	#var_dump($con->error);
	#var_dump($stmt);
	
	echo "Unable to prepare option update statement.";
	$con->close();
	exit();

}

# need to update the guids for each post to point to the new url
$rst = $con->query("select `ID`, `guid` from `wp_posts`");
$stmt = $con->prepare("update `wp_posts` set `guid` = ? where `ID` = ?");
while ($row = $rst->fetch_array(MYSQLI_NUM)) {

	# replace the old server url with the new for each post guid
	if (preg_match('#^http://[A-Za-z.-]+(:[0-9]+)?/#', $row[1])) {
		$urlToSave = preg_replace('#^http://[A-Za-z.-]+(:[0-9]+)?/#', $newServerUrl . '/', $row[1]);
	} else {
		# server url is an ip address
		$urlToSave = preg_replace('#^http://([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})/#', $newServerUrl . '/', $row[1]);
	}

	$stmt->bind_param('si', $urlToSave, $row[0]);
	$stmt->execute();

}
$stmt->close();
$rst->close();
$con->close();

echo "<br>URLs now point to {$newServerUrl}.<br>Done!";

?>