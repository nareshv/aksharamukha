<?PHP

include "./diCrunch/diCrunch_config-en.php";
include "./diCrunch/swap.php";
include "transliterate.php";

$text=$_GET['text'];

$tmp=$text;

//session_start();

foreach($_GET as $key=>$value)

{
    $_SESSION[$key] = strtolower($_GET[$key]);
}

$langtag=array('tamil' => 'dtamil', 'hindi' => 'devanagari', 'sanskrit' => 'devanagari', 'marathi' => 'devanagari', 'iast' => 'unicode', 'iso' => 'unicode2', 'harvard-kyoto' => 'hk');

foreach($langtag as $collang=>$syslang)

{
    if($_SESSION['src']==$collang) $_SESSION['src']=$syslang;
    if($_SESSION['tgt']==$collang) $_SESSION['tgt']=$syslang;
}

if(isset($_GET['natural']))

{

    if($_GET['natural']=="true")

    {

        if($_SESSION['tgt']=="dtamil")

        {

            $_SESSION['nna'] = 1 ;
            $_SESSION['melanu'] = 1;

        }

        if($_SESSION['tgt']=="telugu" || $_SESSION['tgt']=="kannada" )

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

            $_SESSION['conyab'] =1;
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

        if($_SESSION['tgt']=="Malayalam")

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

}

$op = ""; // Echo output is buffered into this variable

// do missing case scenarious

require "./diCrunch/diCrunch_charsets.php";
require "./diCrunch/diCrunch_preprocess.php";

$text = transliterate($text,$_SESSION['src'],$_SESSION['tgt']); // Transliterate the Inputbox Text

$langtag=array('tamil' => 'dtamil', 'iast' => 'unicode', 'iso' => 'unicode2', 'harvard-kyoto' => 'hk');

foreach($langtag as $collang=>$syslang)

{
    if($_SESSION['src']==$syslang) $_SESSION['src']=$collang;
    if($_SESSION['tgt']==$syslang) $_SESSION['tgt']=$collang;
}

$XML = <<<CWS
<?xml version="1.0" encoding="utf-8" ?>
<data>
<source script="{$_SESSION['src']}">{$tmp}</source>
<target script="{$_SESSION['tgt']}">{$text}</target>
</data>
CWS;

echo $XML;

//session_destroy();
