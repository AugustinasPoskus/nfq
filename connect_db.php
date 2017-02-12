<?PHP
DEFINE ('DB_USER','b40e20d30165e7');
DEFINE ('DB_PASSWORD', 'efe1d178');
DEFINE ('DB_HOST', 'us-cdbr-iron-east-04.cleardb.net');
DEFINE ('DB_NAME', 'heroku_0a0df9fb0b9482b');
$db_conx = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to mySQL ' . mysqli_connect_error());
?>