<?PHP

include_once 'config.inc';

$url=$config['url']."/apioutput.php";

echo $url;

$fetch=false;

if(isset($_GET['text'])&&isset($_GET['src'])&&isset($_GET['tgt']))

{

    $url.="?".http_build_query($_GET);

    $fetch=true;

} elseif(isset($_POST['text'])&&isset($_POST['src'])&&isset($_POST['tgt']))

{

    $url.="?".http_build_query($_POST);

    $fetch=true;

}

if($fetch)

{

    $ch=curl_init($url);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $data=curl_exec($ch); //*/

    $data=str_replace("﻿","",$data);

    header("Content-type: text/xml; charset=utf-8");

    echo $data;

} else

    echo "Incorrect Request. Please pass the paremeters correctly";
