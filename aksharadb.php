<?php

echo <<<CWS
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
CWS;

$con = mysql_connect("localhost","virtualv_aksharu","o&B4p;8u9(i)");

mysql_select_db("virtualv_akshara", $con);

mysql_set_charset('utf8',$con);

$result = mysql_query("SELECT * FROM aksharamukha");

echo "<table border='1'>
    <tr>
    <th>Source Text</th>
    <th>Target Text</th>
    <th>Source Script</th>
    <th>Target Script</th>
    </tr>";

while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['srctxt'] . "</td>";
    echo "<td>" . $row['tgttxt'] . "</td>";
    echo "<td>" . $row['src'] . "</td>";
    echo "<td>" . $row['tgt'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysql_close($con);
