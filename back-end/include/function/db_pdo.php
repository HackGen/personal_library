<?php
function PDO_Inst()
{
	if (isset($_ENV['OPENSHIFT_APP_NAME'])) {
		$dbhost = $_ENV['OPENSHIFT_MYSQL_DB_HOST'];
		$dbuser = $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'];
		$dbpass = $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'];
		$dbname = $_ENV['OPENSHIFT_APP_NAME'];
	} else {
		$dbhost = '127.0.0.1';
		$dbuser = 'demo';
		$dbpass = 'demo';
		$dbname = 'liblibrary';
	}

	try {
		return new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	} catch (PDOException $Exception) {
		print_log($Exception->getMessage());
	}
}
