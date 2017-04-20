<?php
/**	config_test.php

    This file will test the configuration for Linux, FreeTDS, 
    MSSQL, & PHP. Change the values where appropriate.

    By: Zach Jetson
    Feel free to use as needed.

    Usage
    -------------
    Run using PHP CLI after editing this file.  Eg:
      $ php config_test.php


    References
    -------------
    - FreeDTS: http://www.freetds.org/userguide/odbcconnattr.htm
    - TDS Versions: http://www.freetds.org/userguide/choosingtdsprotocol.htm
**/

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
error_reporting(E_ALL);


//------ EDIT VALUES HERE -------
$username = "HappyUser"
$password = "SecretPassword"
$dsn_config = [
	// This alias must be setup in /etc/odbcinst.ini
	"Driver=MYSQL_ALIAS",

	// The hostname of the MSSQL server 
	"Server=MyServerHostname.com",

	// TCP Port the server is listening to for requests.
	"Port=9000",

	// The database name you wish to connect.
	"Database=COOLDATA",

	// If the connection is trusted.  This can also be commented out if not needed.
	"Trusted_Connection=No",

	// This version is tied to your version of MSSQL. See reference for TDS Versions for details.
	"TDS_Version=7.4"
];

//------ DON'T EDIT BELOW -------

function mssql_test_connect(){
	try{
	    $dbDB = new PDO( "odbc:" . implode(";", $dsn_strings ), $username, $password );
	    return "SUCCESS"
	} catch (PDOException $e) {
		return "FAIL: " . $e->getMessage();
	}
}

echo "MS SQL Connection Tester" . PHP_EOL;
echo "...use this to test your configuration for errors..." . PHP_EOL;
printf("Connection %'.10s\n", mssql_test_connect());
