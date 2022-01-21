<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$d = dir(getcwd());
while (($file = $d->read()) !== false){
if (strpos($file,".php")==true or strpos($file,".html")==true){
echo "<a href=\"$file\">".$file."</a>\n";
}}

$d->close();
?>
<a href="talo/index.php">kuvaaja</a>
<table>
<tr><th>Nimi</th><th>Arvo</th></tr>
<?php
$db = new SQLite3('/home/talo/data/talo.db');
$result = $db->query("SELECT value,position_name FROM talo_data,talo_positions where time=(select max(time) from talo_data) and position_id = talo_positions.id;");

while($data = $result->fetchArray()){
echo "<tr><td>".$data['position_name']."</td><td>".round($data['value'],1)."</td></tr>\n";}
$db->close();
?>
</table>
<form action="keskiarvo.php" method="post">
<label for="h"> Min, max ja keskiarvot annetulla ajalla: h:</label>
<input type="number" id="h" name="h">
<input type="submit" value="submit">
</form>
</body>
</html>

