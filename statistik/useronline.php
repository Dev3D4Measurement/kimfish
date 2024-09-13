<? 
$to_secs = 120;
$t_stamp = time(); 
$timeout = $t_stamp - $to_secs; 
$REMOTEADDR=$_SERVER['REMOTE_ADDR'];
$PHPSELF=$_SERVER['PHP_SELF'];
mysql_query("INSERT INTO usersonline VALUES ('$t_stamp','$REMOTEADDR','$PHPSELF')") or die("Database INSERT Error : ".mysql_error()); 
mysql_query("DELETE FROM usersonline WHERE timestamp<$timeout") or die("Database DELETE Error : ".mysql_error());
$result = mysql_query("SELECT DISTINCT ip FROM usersonline WHERE file='$PHPSELF'") or die("Database SELECT Error : ".mysql_error());
$user = mysql_num_rows($result); 

if ($user == 1){
echo "<b>$user</b> User";
} 
else{
echo "<b>$user</b> Users";
}
?>