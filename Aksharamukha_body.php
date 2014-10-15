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
$nature_sel="";
$tavarga1_sel="";
$tasub_sel="";
$remshrturd_sel="";
$haaru_sel="";

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
$pref[1] = "thai";

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
        $textareatgt .= "font-family:Sourashtra, Code2000;";
    }

    if ($_SESSION['tgt'] == "urdu") {
        $textareatgt .= "font-family:Scheherazade Urdu;";

    }

    if ($_SESSION['tgt'] == "khmer") {
        $textareatgt .= "font-family:DaunPenh;";

    }

    if ($_SESSION['tgt'] == "burmese" && !empty($_POST['oldbur'])) {
        $textareatgt .= "font-family:Myanmar1;";
    }

    if ($_SESSION['tgt'] == "burmese" && empty($_POST['oldbur'])) {
        $textareatgt .= "font-family:Padauk;";
    }

    if ($_SESSION['tgt'] == "malayalam" && !empty($_POST['mtrad'])) {
        $textareatgt .= "font-family:e-Malayalam OTC;";
    }

}

// Set Font preferences for source scripts

if (!empty($_SESSION['src']))

{

    if ($_SESSION['src'] == "egrantha" || $_SESSION['src'] == "tamil-grantha") {
        $textareasrc .= "font-family:e-Grantamil;";
    }

    if ($_SESSION['src'] == "brahmi") {
        $textareasrc .= "font-family:XenoType Brahmi;";
    }

    if ($_SESSION['src'] == "saurashtra") {
        $textareasrc .= "font-family:Sourashtra, Code2000;";
    }

    if ($_SESSION['src'] == "urdu") {
        $textareasrc .= "font-family:Scheherazade Urdu;";

    }

    if ($_SESSION['src'] == "khmer") {
        $textareatgt .= "font-family:DaunPenh;";

    }

    if ($_SESSION['src'] == "burmese" && !empty($_POST['oldbur'])) {
        $textareasrc .= "font-family:Myanmar1;";
    }

    if ($_SESSION['src'] == "burmese" && empty($_POST['oldbur'])) {
        $textareasrc .= "font-family:Padauk;";
    }

    if ($_SESSION['src'] == "malayalam" && !empty($_POST['mtrad'])) {
        $textareasrc .= "font-family:e-Malayalam OTC;";
    }

}

/* Input Processing */

if (!empty($_POST['source'])) {
    $text = $_POST['source'];
}

/* Or else */

else {

    //if($_SESSION['src'] == "devanagari")

    //{

    //$_POST['source'] = $intro_text;
    $_POST['source'] = "";
    $text = "";

    //}

    //else

    //{

    //$_POST['source'] = " ";
    //$text = " ";

    //}


}

//echo "Source1 is ".$_SESSION['src']."  Target1 is ".$_SESSION['tgt'];


$op = ""; // Echo output is buffered into this variable

include "./diCrunch/diCrunch_charsets.php";
include "./diCrunch/diCrunch_preprocess.php";

if (empty($_SESSION['src'])) {

    //echo "inside loop";

    $_SESSION['src'] = $pref[0];
}
if (empty($_SESSION['tgt'])) {

    //echo "inside loop";
    $_SESSION['tgt'] = $pref[1];
}

if (empty($text)) {
    $_POST['source'] = "";
    $text = "";
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

    if(empty($_GET['nature']))

    {

        if($_SESSION['tgt']=="dtamil")

        {

            $_SESSION['nna'] = 1 ;
            $_SESSION['melanu'] = 1;

        }

        if($_SESSION['tgt']=="telugu" || $_SESSION['tgt']=="kannada" )

        {

            $_SESSION['melanu'] = 2;
            $_SESSION['finalm'] = 1;
            $_SESSION['removedot']= 1 ;

        }

        if($_SESSION['tgt']=="urdu")

        {

            $_SESSION['melanu'] = 2;

        }

        if($_SESSION['tgt']=="malayalam")

        {

            $_SESSION['finalm'] =1;
            $_SESSION['melanu'] = 1;
            $_SESSION['removedot']= 1 ;

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

    } else

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
                unset($_SESSION['removedot']);

            }

            if($_SESSION['tgt']=="urdu")

            {

                unset($_SESSION['melanu']);

            }

            if($_SESSION['tgt']=="Malayalam")

            {

                unset($_SESSION['finalm']);

                unset($_SESSION['removedot']);

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
    cook("nature");
    cook("tavarga1");
    cook("tasub");
    cook("remshrturd");
    cook("removedot");
    cook("haaru");
    cook("santextag");

    if(empty($_POST['nature']))

    {

        // Enable Tamil Trancription by default

        //$_SESSION['transc'] = 1;

        if($_SESSION['tgt']!="dtamil")

        {

            $_SESSION['removedia'] = 1 ;

        }

        if($_SESSION['tgt']=="dtamil")

        {

            $_SESSION['nna'] = 1 ;
            $_SESSION['melanu'] = 1;

        }

        if($_SESSION['tgt']=="telugu" || $_SESSION['tgt']=="kannada" )

        {

            $_SESSION['melanu'] = 2;
            $_SESSION['finalm'] = 1;
            $_SESSION['removedot']= 1 ;

        }

        if($_SESSION['tgt']=="urdu")

        {

            $_SESSION['melanu'] = 2;

        }

        if($_SESSION['tgt']=="malayalam")

        {

            $_SESSION['finalm'] =1;
            $_SESSION['melanu'] = 1;
            $_SESSION['removedot']= 1 ;

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

}

if($webtrans) // if Website Transliteration

{

    $numb = array("1","2","3","4","5","6","7","8","9","0");
    $numbf = array("０","１","２","３","４","５","６","７","８","９");

    // Retain Numerals & Special Characters

    $text = str_replace("_","Ø",$text);
    $text = str_replace("%","ž",$text);
    $text = str_replace($numb,$numbf,$text);
    $text=str_replace("@","[at]",$text);

    //echo "Source is ".$_SESSION['src']."  Target is ".$_SESSION['tgt'];

    $text =  transliterate($text,$_SESSION['src'],$_SESSION['tgt']); // Transliterate the Scraped HTML Content

    // Revert Back Numerals & Special Characters

    $text = str_replace("Ø","_",$text);
    $text = str_replace("ž","%",$text);
    $text = str_replace($numbf,$numb,$text);

    echo $text; // Echo Transliterated HTML

} else // if Website Transliteration is not selected

{

    $text = transliterate($text,$_SESSION['src'],$_SESSION['tgt']); // Transliterate the Inputbox Text

    $ssrc=$_SESSION['src'];
    $ttgt=$_SESSION['tgt'];

    $stylesheet = "diCrunch/diCrunch.css"; // Style Sheet for the Converter

    $op .= <<<CWS
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
    <title>Aksharamukha {$version}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="diCrunch/diCrunch.css" type="text/css" />

<script language="javascript" type="text/javascript">

// Allow only Text File Upload

function txtupld()

{

     name=document.conform.fle.value;
     extind=name.indexOf('.');
     filext=(name.substring(extind+1));

     if (filext!="txt") {
        alert("Only Text files are allowed !");

        return false;
    }


}

// Changeview displays Options based on the Source & Target Script

 function changeView()
 {
try { document.getElementById(document.conform.src.value+'-src').style.display = "block";  } catch (err) { }

try { document.getElementById(document.conform.tgt.value).style.display = "block"; } catch (err) { }

if(document.conform.src.value == "malayalam" || document.conform.src.value == "bengali" || document.conform.src.value == "assamese" || document.conform.src.value == "oriya" )

document.getElementById("texttag").style.display = "block";

else

document.getElementById("texttag").style.display = "none";

if(document.conform.src.value == "sinhala")

document.getElementById("santexttag").style.display = "block";

else

document.getElementById("santexttag").style.display = "none";

if(document.conform.src.value == "devanagari" || document.conform.src.value == "bengali" || document.conform.src.value == "oriya" || document.conform.src.value == "assamese" || document.conform.src.value == "gujarati" )

document.getElementById("north-indic").style.display = "block";

else

document.getElementById("north-indic").style.display = "none";

var selectobject=document.conform.tgt;

for (var i=0; i<selectobject.length; i++) {

if(selectobject.options[i].value!=selectobject.value)

{

try { document.getElementById(selectobject.options[i].value).style.display = "none"; } catch (err) { }

}

}

selectobject=document.conform.src;

for (var i=0; i<selectobject.length; i++) {

if(selectobject.options[i].value!=selectobject.value)

{

try { document.getElementById(selectobject.options[i].value+'-src').style.display = "none"; } catch (err) { }

}

}

}

// Change Text Size

function changeSize()
{
if(document.conform.fsize.value != "16")

{

document.getElementById('target').style.fontSize = document.conform.fsize.value;

document.getElementById('source').style.fontSize = document.conform.fsize.value;

 } else

{

document.getElementById('target').style.fontSize = "";

document.getElementById('source').style.fontSize = "";

 }

                         }

// Change Source Font & Target Font

function changeSrcFont()
{
if(document.conform.sourc.value != "")

{

 document.getElementById('source').style.fontFamily = document.conform.sourc.value;

 }

 }

 function changeTgtFont()
 {
 if(document.conform.targe.value != "")

{

 document.getElementById('target').style.fontFamily = document.conform.targe.value;

 }

 }


// Clear all options

function clearForm()

{

    for (i=0; i<document.conform.elements.length; i++) {

    try { document.conform.elements[i].checked=false;
          document.getElementById('target').style.fontFamily ="";
          document.getElementById('source').style.fontFamily ="";
          document.getElementById('target').style.fontSize=17;
          document.getElementById('source').style.fontSize=17;
          document.conform.targe.value="";
          document.conform.sourc.value="";
          document.conform.fsize.selectedIndex=0;

    } catch (err) {}

    }

}

// Display Options based on the Group Checkbox - Naturalize


function newind()
{

document.conform.setAttribute("target", "_parent");

}


</script>

</head>

<body onload="changeView();changeSize();changeSrcFont();changeTgtFont()">

<div class="container">

CWS;

    /* DEFAULT SCREEN */

    if (empty($_GET['act'])) {

        $op .= <<<CWS


<form name="conform" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}" method="post">
<div class="wrapper">

    <div style="float:left; padding-left: 10px; padding-top: 2px;">
        <b>
        <input type="reset"/>
        <input type="button" name="clear" value="Clear" onClick="clearForm();"/>
        </b>
    </div>

<div align=center><h2><b>Aksharamukha </b>&middot;Asian Script Converter &middot;  Aksharamukha</h2></div>

    <div class="options">


Source: <select name="src" onChange="changeView();">
CWS;
        foreach ($convs as $key => $value) {

            if( $key != "urdu")

            {
                $op .= "<option value=\"$key\"";
                if ($_SESSION['src'] == $key || $src == $key) {
                    $op .= " selected=\"selected\"";
                }
                $op .= ">{$value}</option>\n";
            }
        }

        $op .= <<<CWS
</select>
&nbsp; &nbsp;
Target: <select name="tgt" onChange="changeView();">
CWS;

        foreach ($convs as $key => $value) {
            $op .= "<option value=\"$key\"";
            if ($_SESSION['tgt'] == $key || $tgt == $key) {
                $op .= " selected=\"selected\"";
            }
            $op .= ">{$value}</option>\n";
        }

        $op .= <<<CWS
</select>
&nbsp; &nbsp;

&nbsp;<acronym title="Preserve the Source Text as it is for Reversible Transliteration. Script specific nativization conventions will not be applied">Preserve Source</acronym> <input type="checkbox" name="nature" value="1" style="vertical-align: bottom;" {$nature_sel}  />

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Remove all diacritic symbols/characters"><b>No Diacritics</b></acronym> <input type="checkbox" name="removedia" value="1" style="vertical-align: bottom;" {$removedia_sel}/>

</div>

</div>

<div class="wrapper" id= "north-indic" style="padding-top: 0px; display: none; ">

<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>North Indic Scripts : </b>

<acronym title="Remove the final schwa in North Indic texts e.g निरोध gets transliterated to 'nirodh' instead of 'nirodha'">Remove 'a'</acronym> <input type="checkbox" name="finala" value="1" style="vertical-align: bottom;" {$finala_sel}/>

<br/>

 </div>

</div>

<div class="wrapper" id="dtamil-src" style="padding-top: 0px;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Tamil Input : </b>

<acronym title="Transcribe Tamil Text to reflect the actual pronunciation. e.g அங்கே gets transcribed into 'ange' instead of getting transliterated into 'anke'"><b> Enable Transcription </b></acronym> <input type="checkbox" name="transc" value="1" style="vertical-align: bottom;" {$transc_sel}/>

</div>
</div>

<div class="wrapper" id="malayalam" style="padding-top: 0px; display: none;">

    <div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Malayalam : </b>
<acronym title="Disable Chillus in the Transliterated Text">Disable Chillus</acronym> <input type="checkbox" name="pchillu" value="1" style="vertical-align: middle;" {$pchillu1_sel}/>

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use Old Au vowels sign rather than the modern sign  ൗ to ൌ ">Archaic Au </acronym> <input type="checkbox" name="mau" value="1" style="vertical-align: bottom;" {$mau_sel}/>

    &nbsp; <b>&middot;</b> &nbsp;

 <acronym title="Use Traditional Malayalam Orthography. Requires e-Malayalam OTC font be installed">Traditional Orthography</acronym> <input type="checkbox" name="mtrad" value="1" style="vertical-align: bottom;" {$mtrad_sel}/>

 </div>

</div>

<div class="wrapper" id="urdu" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
<b>Urdu : </b>

<acronym title="Remove short vowel characters - Zer/Pesh/Zabar from the text">Remove Short Vowels</acronym> <input type="checkbox" name="remshrturd" value="1" style="vertical-align: bottom;" {$remshrturd_sel}/>
</div>
</div>

<div class="wrapper" id="saurashtra" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
<b>Sourashtra : </b>

<acronym title="Use Haaru for aspirated mha, nha, lha, rha">Use Haaru</acronym> <input type="checkbox" name="haaru" value="1" style="vertical-align: bottom;" {$haaru_sel}/>
</div>
</div>


<div class="wrapper" id="dtamil" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
<b>Tamil : </b>

<acronym title="Use ஶ instead of  ஸ²">Use ஶ SHA</acronym> <input type="checkbox" name="replacesha" value="1" style="vertical-align: bottom;" {$replacesha_sel}/>

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use Tamil symbol OM ௐ ">Tamil OM</acronym> <input type="checkbox" name="taom" value="1" style="vertical-align: bottom;" {$taom_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Mark First Varga letters with Numeral 1. करम  to க¹ரம்">Mark First Varga Letters</acronym> <input type="checkbox" name="tavarga1" value="1" style="vertical-align: bottom;" {$tavarga1_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use Subscript Numerals instead of Superscript numerals for marking Varga letters. பு³த்³த⁴ to பு₃த்₃த₄ ">Use Subscript Numerals</acronym> <input type="checkbox" name="tasub" value="1" style="vertical-align: bottom;" {$tasub_sel}/>

</div>
</div>

<div class="wrapper" id="sinhala" style="padding-top: 0px; display:none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Sinhala : </b>

<acronym title="Enable Rephaya & Combining Conjuncts in the Sinhala Text e.g ධ‍ර්‍ම  instead of ධර්ම ">Enable Rephaya & Combining Conjuncts</acronym> <input type="checkbox" name="level2" value="1" style="vertical-align: bottom;" {$level2_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Tag the Sinhala text as Sanskit/Pali. Following Sanskrit/Pali Conventions, Short e & Short o will be used to represent Long e and Long o. e.g නමො  instead of නමෝ ">Sanskrit/Pali Text</acronym> <input type="checkbox" name="sanpali" value="1" style="vertical-align: bottom;" {$sanpali_sel}/>

</div>
</div>

<div class="wrapper" id="punjabi" style="padding-top: 0px; display:none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Punjabi (Gurmukhi) : </b>

<acronym title="Disable the usage of Addak in the transliterated text">Disable Addak</acronym> <input type="checkbox" name="disaddak" value="1" style="vertical-align: bottom;" {$disaddak_sel}/>

    </div>
</div>

<div class="wrapper" id="tibetan" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Tibetan : </b>

<acronym title="Use ba བ instead of wa ཝ">wa to ba.</acronym> <input type="checkbox" name="vaba" value="1" style="vertical-align: bottom;" {$vaba_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use the stylized Bindu with Nada  ྂ instead of  ྃ Bindu (Chandrabindu) ">Bindu with Nada</acronym> <input type="checkbox" name="stanu" value="1" style="vertical-align: bottom;" {$stanu_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Convert Spaces into Tsheg Marker">Space to Tsheg</acronym> <input type="checkbox" name="spac" value="1" style="vertical-align: bottom;" {$spac_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Remove the Explicit Viramas. པད྄ to པད">Remove Virama</acronym> <input type="checkbox" name="virem" value="1" style="vertical-align: bottom;" {$virem_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use Normal Ra instead of Fixed Form Ra (for compatability with certain Fonts)">Normal Ra</acronym> <input type="checkbox" name="normra" value="1" style="vertical-align: bottom;" {$normra_sel}/>

</div>
</div>

<div class="wrapper" id="oriya" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Oriya : </b>
<acronym title="Use ଵ  to present the Sanskrit /v/. ଶିବ  becomes ଶିଵ  ">Use Va</acronym> <input type="Checkbox" name="wava" value="2" style="vertical-align: bottom;" {$wava2_sel}/>

&nbsp; <b>&middot;</b> &nbsp;

<acronym title="Use Oriya ya ଯ to produce /ya/ phala">YA Phala</acronym> <input type="checkbox" name="yaphala" value="1" style="vertical-align: bottom;" {$yaphala_sel}/>
</div>
</div>
<div class="wrapper" id="bengali" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Bengali : </b>

<acronym title="Replace Khanda-Ta ত্‍ by Virama-Ta ত্ ">Disable Khanda Ta</acronym> <input type="checkbox"  name="remkhata" value="1" style="vertical-align: bottom;" {$remkhata1_sel}/>

</div>
</div>

<div class="wrapper" id="assamese" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Assamese : </b>
<acronym title="Replace Khanda-Ta ত্‍ by Virama-Ta ত্ ">Disable Khanda Ta</acronym> <input type="checkbox" name="aremkhata" value="1" style="vertical-align: bottom;" {$aremkhata1_sel}/>

</div>
</div>

<div class="wrapper" id="burmese" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
<b>Burmese : </b>

<acronym title="Use old Burmese Unicode conventions. Convert text to 'Myanmar1' font standards">Old Burmese Unicode</acronym> <input type="checkbox" name="oldbur" value="1" style="vertical-align: bottom;" {$oldbur_sel}/>

</div>
</div>

<div class="wrapper" id="thai" style="padding-top: 0px; display: none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
<b>Thai : </b>

<acronym title="Transcribe text following Thai transcription conventiosn. e.g tathāgata gets transcribed to ตะถาคะตะ  in Thai instead of ตถาคต .">Transcribe into Thai</acronym> <input type="checkbox" name="shorta" value="1" style="vertical-align: bottom;" {$shorta_sel}/>

</div>
</div>

<div id="texttag" style="padding-top: 0px; display:none; ">
</div>

<div class="wrapper" id="santexttag" style="padding-top: 0px; display:none; ">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">


<b>Sinhala Input: </b>

<acronym title="Tag the Sinhala text as Sanskit/Pali. Following Sanskrit/Pali Conventions, Short e & Short o will be used to represent Long e and Long o. e.g නමො  instead of නමෝ "><b>Sanskrit/Pali Text</b></acronym> <input type="checkbox" name="santextag" value="1" style="vertical-align: bottom;" {$santextag_sel}/>

</div>
</div>

<div class="wrapper" id="thai-src" style="padding-top: 0px; display:none;">
<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">

<b>Thai Input : </b>

<acronym title="The Input text is Transcribed thai text, and not Transliterated Thai.  "><b>Transcribed Thai</b></acronym> <input type="checkbox" name="transthai" value="1" style="vertical-align: bottom;" {$transthai_sel}/>

</div>
</div>

<div class="wrapper">
<div class="options">

<b><a href="http://www.virtualvinodh.com/aksharamkh/aksharamukha-web.php" target="_parent">Click here to convert entire Website</a><b>

</div>
</div>

<div class="wrapper">

<div class="textareabg">

CWS;

        $tmp = str_replace("\'", "'", $tmp); //escaping escape character is source too

        $op .= <<<CWS
    <textarea id="source" cols="60" rows="10" style="{$textareasrc}" name="source">{$tmp}</textarea>
    <br />
    <textarea id="target" cols="60" rows="10" style="{$textareatgt}" name="target">{$text}</textarea>
CWS;

        $op .= <<<CWS
    <br />

    <input type="submit" name="convert" value="Convert" accesskey="c" class="button" />

    &nbsp; &middot; &nbsp;

    Font Size :
        <select name=fsize onChange="changeSize()";>

CWS;

        $FSize = "";
        $SourcV = "";
        $TargeV = "";

        if(!empty($_POST['fsize']))

        {
            $FSize = $_POST['fsize'];

        }

        if(!empty($_POST['sourc']))

        {
            $SourcV = $_POST['sourc'];

        }

        if(!empty($_POST['targe']))

        {
            $TargeV = $_POST['targe'];

        }

        for ($count=16;$count<=35;$count++) { $op .= "<option value = {$count}";
        if ($FSize == $count) {
            $op .= " selected=\"selected\"";

        }

        $op .="> {$count}</option>\n"; }
        $op .= <<<CWS
        </select>

    &nbsp; &middot; &nbsp;

 Source Font: <input name="sourc" size="15" value="{$SourcV}" onchange=changeSrcFont();></input>

 Target Font: <input name="targe" size="15" value="{$TargeV}" onchange=changeTgtFont();></input>

</div>

</div>

CWS;

        if (!empty($fileoutput_sel)) {
            $fileoutput_display = "block";
        } else {
            $fileoutput_display = "none";
        }

        $op .= <<<CWS

<div class="wrapper">
<div class="options">
Upload Text File : <input type="file" name="fle" value="Upload" accesskey="c" class="button" /><input type="submit" name="convert" value="Convert File" accesskey="c" class="button" onclick="return txtupld()">

</div>

</div>

<div class="wrapper">
<div align=leftr><h2><b>For help pages: Visit : <a href="http://www.virtualvinodh.com/quickguide" target="_parent">http://www.virtualvinodh.com/quickguide</a></h2></b></div>
</div>
<div class="wrapper">

<div class="textareabg">
<ul>
<li> A Comparative table of all the Scripts can be found at <a href="http://www.virtualvinodh.com/character-matrix" target="_parent">Character Matrix</a><br/><br/>
<li> Grantha & Tamil-Grantha needs <a href="http://www.uni-hamburg.de/Wiss/FB/10/IndienS/Kniprath/INDOLIPI/e-Grantamil.zip">e-Grantamil</a> font to be installed. <br/><br/>
<li>To view Option Tooltip, place the pointer on the Option Label <br/>
<li><b>Hindi and Sanskrit (in General) are written using Devanagari</b> <br/>
</br>
<li> The Transliterated Webpages may not be properly formatted.

<br/>
</ul>
<b> Project hosted at Launchpad : <a href="http://www.launchpad.net/aksharamukha" target="_parent">http://www.launchpad.net/aksharamukha</a> </b> </br> <br/>
Mail Bugs and Suggestions to vinodh [at] virtualvinodh [dot] com <br/> <br/>
</div>

</div>

</div>

</div>


</form>

CWS;

    }

    $y = date("Y");

    $op .= <<<CWS

<!-- You may not remove this footer with copyright notice from the code. Thank you. -->

<div class="copyright"> The software is released uner GNU GPL License. You may read the license <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">here</a><br/>This tool was developed from diCrunch source code by <b>Vinodh Rajan </b><br/> <a href="http://www.codewallah.com/diCrunch/thoorihai.php?act=license" target="_blank">diCrunch</a> {$version} &copy; 2006-{$y} mAdhavAnanda <b>&middot;</b> a Bhasa.Net resource  <br/></div>

</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12241465-1");
pageTracker._trackPageview();
} catch (err) {}</script>
</body>

</html>

CWS;

    echo $op; // Blurt out the output buffer

}
