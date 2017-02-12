<?PHP
DEFINE ('DB_USER','b2adc5e7d94acb');
DEFINE ('DB_PASSWORD', '88fce72b');
DEFINE ('DB_HOST', 'us-cdbr-iron-east-04.cleardb.net');
DEFINE ('DB_NAME', 'heroku_eec8414836f0513');
$db_conx = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to mySQL ' . mysqli_connect_error());
?>