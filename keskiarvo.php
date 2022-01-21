<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<table>
<tr><th>nimi</th><th>pienin arvo</th><th>suurin arvo</th><th>keskiarvo</th></tr>
<?php
$h = $_POST['h'];
$db= new sqlite3('/home/talo/data/talo.db');
$result= $db->query("SELECT position_name,MAX(value),MIN(value),avg(value) from talo_data,talo_positions WHERE time >= datetime('now','-$h hours') and position_id=talo_positions.id GROUP by position_id");
while($data = $result->fetchArray()){echo "<tr><td>".$data['position_name']."</td><td>".round($data['MIN(value)'],1)."</td><td>".round($data['MAX(value)'],1)."</td><td>".round($data['avg(value)'],1)."</td></tr>\n";}
?>
</table>
</body>
</html>
