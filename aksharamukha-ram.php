<?PHP
/*
#####################################################################
## diCrunch - Indic language diacritic and script converter
 ## Copyright (C) 2006-2007 Madhavananda Das & Gaudiya Kutir, Inc.
## Online at http://wiki.gaudiyakutir.com/gkWiki:DiCrunch
 ## Send bug reports and inquiries to dicrunch[AT]bhasa[DOT]net
########################################################################

The gkWiki:diCrunch engine is released under GNU General Public License. This document contains a human-readable summary of the full GPL text along with the full GPL text.

A summary of the license is also available online at http://creativecommons.org/licenses/GPL/2.0/. The full GPL text is available online at http://www.gnu.org/copyleft/gpl.html.

Please read the diCrunch_license.txt file for the full texts.

 */

include "./diCrunch/diCrunch_config-en.php";
include "./diCrunch/swap.php";
include "transliterate.php";
include "web_transliterater.php";
include "cook.php";

// Initialize Option Variables

$avagra_sel="";
$melanu1_sel="";
$melanu2_sel="";
$finala_sel="";
$finalm_sel="";
$removedia_sel="";
$replacesha_sel="";
$ri_sel="";
$taom_sel="";
$nna_sel="";
$ksha_sel="";
$knukta_sel="";
$oldbur_sel="";
$santextag_sel="";
$transtext_sel="";
$pchillu1_sel="";
$pchillu2_sel="";
$mau_sel="";
$mtrad_sel="";
$aremkhata2_sel="";
$conyab2_sel="";
$aremkhata1_sel="";
$conyab1_sel="";
$remkhata2_sel="";
$aconyab2_sel="";
$remkhata1_sel="";
$aconyab1_sel="";
$vabab_sel="";
$yaphala_sel="";
$wava1_sel="";
$yayya1_sel="";
$wava2_sel="";
$yayya2_sel="";
$shorta_sel="";
$anugna_sel="";
$transthai_sel="";

$version = "v3.00";

/* Initial preference and option variables */

$textareasrc = "";
$count=0;
$textareatgt = "";
$pref[12] = "";
$pref[13] = "";

$src="";
$tgt="";

// Store Form Attributes in Session

if (!empty($_POST['src'])) { $_SESSION['src']=$_POST['src']; $src=$_SESSION['src'];}
if (!empty($_POST['tgt'])) { $_SESSION['tgt']=$_POST['tgt']; $tgt=$_SESSION['tgt']; }

if (!empty($_SESSION['src'])) { $_SESSION['src']=$_SESSION['src']; $src=$_SESSION['src'];}
if (!empty($_SESSION['tgt'])) { $_SESSION['tgt']=$_SESSION['tgt']; $tgt=$_SESSION['tgt']; }

/* Get user preferences */

$pref[0] = "devanagari";
$pref[1] = "telugu";

// Set Font Preferences based on Target Script

if (!empty($_SESSION['tgt']))

{

    if ($_SESSION['tgt'] == "egrantha" || $_SESSION['tgt'] == "tamil-grantha") {
        $textareatgt .= "font-family:e-Grantamil;";
    }

    if ($_SESSION['tgt'] == "brahmi") {
        $textareatgt .= "font-family:XenoType Brahmi;";
    }

    if ($_SESSION['tgt'] == "saurashtra") {
        $textareatgt .= "font-family:Code2000;";
    }

    if ($_SESSION['tgt'] == "burmese" && !empty($_POST['oldbur'])) {
        $textareatgt .= "font-family:Myanmar1;";
    }

    if ($_SESSION['tgt'] == "malayalam" && !empty($_POST['mtrad'])) {
        $textareatgt .= "font-family:e-Malayalam OTC;";
    }

}

/* Input Processing */

if (!empty($_POST['source'])) {
    $text = $_POST['source'];
}

/* Or else */

else {

    $_POST['source'] = $intro_text;
    $text = $intro_text;
}

$op = ""; // Echo output is buffered into this variable

include "./diCrunch/diCrunch_charsets.php";
include "./diCrunch/diCrunch_preprocess.php";

if (empty($_SESSION['src'])) {
    $_SESSION['src'] = $pref[0];
}
if (empty($_SESSION['tgt'])) {
    $_SESSION['tgt'] = $pref[1];
}

if (empty($text)) {
    $_POST['source'] = $intro_text;
    $text = $intro_text;
}

if (!empty($_FILES['fle']['name']))

{
    $ext = explode(".", $_FILES['fle']['name']);
    $ext = array_pop($ext);

    if ($ext=='txt') {
        $tmp = file_get_contents($_FILES['fle']['tmp_name']);
        $tmp = str_replace("﻿","",$tmp);
        $_POST['source'] = $tmp;
        $text=$tmp;
    }
}

/* If form input */

elseif (!empty($_POST['source'])) {
    $text = $_POST['source'];
}

$tmp=$text;

$webtrans=false;

// If Website field is not empty [POST & GET], scrape the content of the Site

if(!empty($_POST['website']))

{
    //  header("Location: http://localhost/aksharamukha/aksharamukha.php?website=".($_POST['website']));

    $text = web_transliterater($_POST['website']);
    $webtrans=true;

}

if(!empty($_GET['website']))

{

    //if(!empty($_GET['finalm'])) $_SESSION['finalm'] = $_GET['finalm'];
    //if(!empty($_GET['avagra'])) $_SESSION['avagra'] = $_GET['avagra'];
    //if(!empty($_GET['melanu'])) $_SESSION['melanu'] = $_GET['melanu'];

    foreach($_GET as $key=>$value)

    {

        if ($_GET[$key]!=0) {

            $_SESSION[$key] = $_GET[$key];

        } else

        {
            unset($_SESSION[$key]);

        }

    }

    $langtag=array('tamil' => 'dtamil', 'hindi' => 'devanagari', 'sanskrit' => 'devanagari', 'marathi' => 'devanagari', 'iast' => 'unicode', 'iso' => 'unicode2', 'harvard-kyoto' => 'hk');

    if(!empty($_GET['src'])) $_SESSION['src'] = strtolower($_GET['src']);
    if(!empty($_GET['src'])) $_SESSION['tgt'] = strtolower($_GET['tgt']);

    foreach($langtag as $collang=>$syslang)

    {
        if($_SESSION['src']==$collang) $_SESSION['src']=$syslang;
        if($_SESSION['tgt']==$collang) $_SESSION['tgt']=$syslang;
    }

    $ssrc=$_SESSION['src'];
    $ttgt=$_SESSION['tgt'];
    $ssite=$_GET['website'];

    if($_GET['natural']=="true")

    {

        if($_SESSION['tgt']=="dtamil")

        {

            $_SESSION['nna'] = 1 ;
            $_SESSION['melanu'] = 1;

        }

        if($_SESSION['tgt']=="telugu" || $_SESSION['tgt']=="telugu" )

        {

            $_SESSION['melanu'] = 2;
            $_SESSION['finalm'] =1;

        }

        if($_SESSION['tgt']=="malayalam")

        {

            $_SESSION['finalm'] =1;

        }

        if($_SESSION['tgt']=="bengali")

        {

            $_SESSION['conyab'] = 1;
            $_SESSION['vabab'] =1;

        }

        if($_SESSION['tgt']=="oriya")

        {

            $_SESSION['yayya'] = 1;
            $_SESSION['wava'] =1;

        }

        if($_SESSION['tgt']=="assamese")

        {

            $_SESSION['aconyab'] = 1;

        }

    }

    if($_GET['natural']=="false")

    {

        if($_SESSION['tgt']=="dtamil")

        {

            unset($_SESSION['nna']) ;
            unset($_SESSION['melanu']);

        }

        if($_SESSION['tgt']=="telugu" || $_SESSION['tgt']=="telugu" )

        {

            unset($_SESSION['melanu']);
            unset($_SESSION['finalm']);

        }

        if($_SESSION['tgt']=="malayalam")

        {

            unset($_SESSION['finalm']);

        }

        if($_SESSION['tgt']=="bengali")

        {

            unset($_SESSION['conyab']);
            unset($_SESSION['vabab']);

        }

        if($_SESSION['tgt']=="oriya")

        {

            unset($_SESSION['yayya']);
            unset($_SESSION['wava']);

        }

        if($_SESSION['tgt']=="assamese")

        {

            unset($_SESSION['aconyab']);

        }

    }

    $text = web_transliterater($_GET['website']);

    $webtrans=true;

}

if(empty($_GET['website']))

{

    //Store Option Selections in Session Variable

    cook("avagra");

    cookrad("melanu");
    cookrad("pchillu");
    cookrad("remkhata");
    cookrad("aremkhata");
    cookrad("conyab");
    cookrad("aconyab");
    cookrad("wava");
    cookrad("yayya");

    cook("finalm");
    cook("finala");
    cook("removedia");
    cook("replacesha");
    cook("ri");
    cook("taom");
    cook("nna");
    cook("ksha");
    cook("knukta");
    cook("oldbur");
    cook("transc");
    cook("mau");
    cook("mtrad");
    cook("vabab");
    cook("level2");
    cook("sanpali");
    cook("disaddak");
    cook("guruvisarg");
    cook("vaba");
    cook("stanu");
    cook("spac");
    cook("virem");
    cook("normra");
    cook("yaphala");
    cook("shorta");
    cook("anugna");
    cook("transthai");

}

if($webtrans) // if Website Transliteration

{

    $numb = array("1","2","3","4","5","6","7","8","9","0");
    $numbf = array("０","１","２","３","４","５","６","７","８","９");

    // Retain Numerals & Special Characters

    $text = str_replace("_","Ø",$text);
    $text = str_replace("%","ž",$text);
    $text = str_replace($numb,$numbf,$text);
    $text= str_replace("@","[at]",$text);

    $itag=array();

    $i=0;

    $text=preg_replace("@(?<=<em>)(.*?)(?=</em>)@e",'conv("\1")',$text); // Transliterate the Scraped HTML Content

    //$text=preg_replace("@(?<=<em>)(.*?)(?=</em>)@e",'"%"."$i++"',$text);

    $text = transliterate($text,$_SESSION['src'],$_SESSION['tgt']);

    // Revert Back Numerals & Special Characters

    $text = str_replace("Ø","_",$text);
    $text = str_replace("ž","%",$text);
    $text = str_replace($numbf,$numb,$text);

    $text=str_replace("http://www.virtualvinodh.com/aksharamkh/","",$text);

    echo $text; // Echo Transliterated HTML

} else // if Website Transliteration is not selected

{

    $text = transliterate($text,$_SESSION['src'],$_SESSION['tgt']); // Transliterate the Inputbox Text

}

function conv($text)

{

    $url="http://www.virtualvinodh.com/aksharamkh/aksharamukha-api.php";

    $params=array("src" => "itrans", "tgt" => "{$_SESSION['tgt']}","text" => "{$text}", "natural" => "true", "pchillu" => "2" );
    $url.="?".http_build_query($params);
    $ch=curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $data=curl_exec($ch);

    $xml=simplexml_load_string($data);

    foreach ($xml->children() as $child) {

        if($child->getName() == "target")  return $child;

    }

}
