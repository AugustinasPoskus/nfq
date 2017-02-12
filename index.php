<?PHP
require_once('connect_db.php');
$sql = "SELECT COUNT(*) FROM `heroku_0a0df9fb0b9482b`.book";
$query = mysqli_query($db_conx, $sql);
$row = mysqli_fetch_row($query);
$rows = $row[0];
$page_rows = 5;
$last = ceil($rows/$page_rows);
if($last < 1){
	$last = 1;
}
$pagenum = 1;
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
$sql = "SELECT id, title FROM `heroku_0a0df9fb0b9482b`.book $limit";
$query = mysqli_query($db_conx, $sql);
$textline1 = "Books (<b>$rows</b>)";
$paginationCtrls = '';
if($last != 1){
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	$paginationCtrls .= '<a class="selected-page">'.$pagenum.'</a> &nbsp; ';
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';
    }
}
$list = '';
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$id = $row["id"];
	$title = $row["title"];
	$list .= '<p><a class="list-group-item list-group-item-action" href="book.php?id='.$id.'">'.$title.'</a></p>';
}
mysqli_close($db_conx);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script type="text/javascript" 
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="articles.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>
<div class="container">
  <h2><?php echo $textline1; ?></h2>
  <div class="list-group"><?php echo $list; ?></div>
  <div class="pagination" id="pagination_controls"><?php echo $paginationCtrls; ?></div>
</div>
</body>
</html>