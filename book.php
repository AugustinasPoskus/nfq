<?PHP
require_once('connect_db.php');
$Id = $_GET['id'];
$sql = "SELECT Id, title, release_year, Genre FROM `heroku_0a0df9fb0b9482b`.book WHERE Id = $Id";
$sql2 = "SELECT At.Name, At.LastName FROM `heroku_0a0df9fb0b9482b`.book AS Bk , 
`heroku_0a0df9fb0b9482b`.author AS At, `heroku_0a0df9fb0b9482b`.bookauthors AS BA 
WHERE BA.BookId =  $Id AND Bk.Id = BA.BookId AND At.Id = BA.authorId";
$result = @mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_row($result)) {
	$title=$row[1];
	$release_year=$row[2];
	$genre=$row[3];
}
$result1 = @mysqli_query($db_conx, $sql2);
$totalCount = mysqli_num_rows($result1);
$author='';
$count = 1;
while ($row = mysqli_fetch_row($result1)) {
	$author.=$row[0].' '.$row[1];
	if($count != $totalCount)
		$author.=', ';
	$count++;
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title.' by '.$author; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/1-col-portfolio.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title; ?>
                    <small><?php echo ' by ' . $author; ?></small>
                </h1>
            </div>
        </div>
   
        <div class="row">
            <div class="col-md-7">
                <a href="#">
                    <img class="img-responsive" src="http://pngimg.com/upload/book_PNG2115.png" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3>Released in: <?php echo $release_year ?></h3>
                <h4>Genre: <?php echo $genre ?></h4>
            </div>
        </div>
    
    </div>

</body>

</html>
