<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "bettan");

	$db_connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	//Kontrollerar att den finns någon anslutning till db
	if($db_connect->connect_errno) {
		echo "Det gick inte att ansluta till databasen " . $db_connect->connect_error;
		exit();
	}
	// else {
	// 	echo "Det funkar";
	// }

	$db_connect->set_charset("utf8");
?>