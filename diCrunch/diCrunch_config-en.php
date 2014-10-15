<?PHP

/* Processing time limit in seconds */

set_time_limit(150);

/* Intro text */

$intro_text = <<<CWS

ये धर्मा हेतुप्रभवा 
हेतुं तेषां तथागतो ह्यवदत् ।
तेषां च यो निरोध 
एवं वादी महाश्रमणः  ॥

              -- प्रतीत्यसमुत्पाद हृदय धारणी
                                                                  
CWS;


/* A list of available conversion options */

$convs = array (
	"brahmi" => "Asokan Brahmi (Xenotype)",	
	"assamese" => "Assamese",
	"bengali" => "Bengali",
	"burmese" => "Burmese",
	"devanagari" => "Devanagari",
	"egrantha"=>"Grantha (Indolipi)",
 	"gujarati" => "Gujarati",
	"kannada" => "Kannada",
	"khmer" => "Khmer (Cambodian)",
	"malayalam" => "Malayalam",
	"oriya" => "Oriya",
	"punjabi" => "Punjabi (Gurmukhi)",	
	"saurashtra" => "Saurashtra",
	"sinhala" => "Sinhala",
	"dtamil" => "Tamil",
	"tamil-grantha"=>"Hybrid Tamil-Grantha",
    "telugu" => "Telugu",
	"thai" => "Thai",
	"tibetan" => "Tibetan",
	"urdu" => "Urdu",
	//"arabic" => "Arabic",
	"hk" => "Harvard-Kyoto",
	"unicode" => "IAST",
	"unicode2" => "ISO",
	"itrans" => "ITRANS",
	"velthuis" => "Velthuis",
	"cologne" => "Cologne(Tamil)"
);

if(!function_exists('dtext')) {


function dtext($dtext)

{

//echo $dtext;

$larray=array("a","b","c","d","e","f","g","h","i","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","j");
$carray=array("а","б","в","г","д","я","е","ж","з","и","й","к","ё","л","м","н","о","п","с","т","у","ф","ц","ч","ш","щ");
$larray2=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$carray2=array("А","Б","В","Г","Д","Е","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ");   

$dtext = str_replace($larray,$carray,$dtext);             
$dtext = str_replace($larray2,$carray2,$dtext);

//echo $dtext;

$dtext = preg_replace("/(##)(.*)##/","$2",$dtext);

return $dtext; 
 
}

}


?>