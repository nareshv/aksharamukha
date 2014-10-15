<?PHP

include_once 'config.inc';

$url=$config['url']."/aksharamukha-api.php";

$params=array("src" => "dtamil", "tgt" => "telugu", "natural" => "true", "text" => "வினோத் ராஜன்");

$url.="?".http_build_query($params);

$ch=curl_init($url);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$data=curl_exec($ch);

echo "<html><body>";

echo "<h1>My Name is ".$data."</h1>";

echo "</body></html>";

curl_close($ch);
