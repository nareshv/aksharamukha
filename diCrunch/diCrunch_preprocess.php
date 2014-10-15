<?PHP

$larray=array("a","b","c","d","e","f","g","h","i","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","j");
$carray=array("а","б","в","г","д","я","е","ж","з","и","й","к","ё","л","м","н","о","п","с","т","у","ф","ц","ч","ш","щ");
$larray2=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$carray2=array("А","Б","В","Г","Д","Е","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ");   

$Chillu_atom=array("ൺ","ൻ","ർ","ൽ","ൾ","ൿ");
$Chillu_zwj=array("ണ്‍","ന്‍","ര്‍","ല്‍","ള്‍","ക്‍");

// Khmer Viramas to Normal Viramas

$vir_vis=array("៑");
$vir_norm=array("្");

$text=str_replace($vir_vis,$vir_norm,$text);


/* Sinhala prenasalized consonants in Tamil */

$text = str_replace("்ˆ","ஂˆ",$text);

$text = str_replace($Chillu_atom,$Chillu_zwj,$text); //Replace Atomic Chillus with ZWJ

 $fulform=array("྄ཀ","྄ཁ","྄ག","྄གྷ","྄ང","྄ཅ","྄ཆ","྄ཇ","྄ཉ","྄ཊ","྄ཋ","྄ཌ","྄ཌྷ","྄ཎ","྄ཏ","྄ཐ","྄ད","྄དྷ","྄ན","྄པ","྄ཕ","྄བ","྄བྷ","྄མ","྄ཙ","྄ཚ","྄ཛ","྄ཛྷ","྄ཝ","྄ཞ","྄ཟ","྄འ","྄ཡ","྄ར","྄ལ","྄ཤ","྄ཥ","྄ས","྄ཧ");

 $subform=array("ྐ","ྑ","ྒ","ྒྷ","ྔ","ྕ","ྖ","ྗ","ྙ","ྚ","ྛ","ྜ","ྜྷ","ྞ","ྟ","ྠ","ྡ","ྡྷ","ྣ","ྤ","ྥ","ྦ","ྦྷ","ྨ","ྩ","ྪ","ྫ","ྫྷ","ྭ","ྮ","ྯ","ྰ","ྱ","ྲ","ླ","ྴ","ྵ","ྶ","ྷ");

 $oldvow=array("ྲྀ","ཷ","ླྀ","ཹ");  
 $newvow=array("ྲྀ","ྲཱྀ","ླྀ","ླཱྀ");

/* correct slashes & quote */

/* Add an extra space at the end of the text */

/* Normalization of Unicode Text */

include "./diCrunch/normalize.php";

/* First character of line as full vowel in scripts */

$text = str_replace("\n", "\n ", $text);

/* Exceptions */

if (!empty($_SESSION['src'])) {

if ($_SESSION['src']!='malayalam')

{

$text = str_replace("‍","",$text);  // Remove ZWJ - Only in Malayalam ZWJ carries a Semantic Meaning. Probably the reason why Atomic Chillus were introduced.

}

if ($_SESSION['src']=='unicode' || $_SESSION['src']=='unicode2' )

{

$text = str_replace("q", "ｑ", $text); // Conversion of Internal Processing 
$text = str_replace("z", "ż", $text);
}

//if ($_SESSION['src']=='hk' )

{

//$text = str_replace("q", "ｑ", $text);

}

if ($_SESSION['src']=='itrans')

{

$text = str_replace("^R", "^Ｒ", $text); // Conversion of Internal Processing


}

/* Replace Old Burmese Unicode Conventions with New Burmese Unicode Conventions */

if ($_SESSION['src']=='burmese')

{

	$my_old=array("္ယ","္ရ","္ဟ","္ဝ","င္","သ္သ","ဉ္ဉ","ာ"); // Old Unicode Conventions
	$my_new=array("ျ","ြ","ှ","ွ","င်္","ဿ","ည","ါ");  // New Unicode Conventions

	$text = str_replace($my_new,$my_old, $text);

	$text = str_replace("်","္",$text); // Replace Old Generic Virama with Subjoining Virama
	
	$text = str_replace("ာ္","ာ်",$text);
	

}

//echo $text;

if ($_SESSION['src']=='unicode' || $_SESSION['src']=='unicode2')

{

// Convert Capital Letters to Small Letters

$upper_alph=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W"," X","Y","Z","Ā","Ī","Ū","Ṛ","Ṝ","Ḷ","Ḹ","Ē","Ō","Ṅ","Ñ","Ṭ","Ṇ","Ś","Ṣ","Ṟ","Ṉ","Ḻ");

$lower_alph=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","ā","ī","ū","ṛ","ṝ","ḷ","ḹ","e","o","ṅ","ñ","ṭ","ṇ","ś","ṣ","ḻ","ṟ","ṉ");

$text=str_replace($upper_alph,$lower_alph,$text);

}

	
	/* ITRANS alternative normalizing */
	
	if ($_SESSION['src'] == "itrans") {
	
		$se = array("OM","AUM", "aa", "ii", "uu", "RRi", "RRI","LLi", "LLI", "N^", "ssh", "GY", "dny", "JN", "x", ".m", ".n","{}","ch","Ch","C","shh","R","^Ｒ^","a.c",".c","z");
		
		$re = array("oM","oM", "A", "I", "U", "R^i", "R^I", "L^i", "L^I", "~N", "Sh", "j~n", "j~n", "~n","kS", "M", "M", "_","c","ch","ch","Sh","^Ｒ","R^","a^e","a^e","J");
		
		$nukcor=array("K","q","G","J",".Dh",".D");				
		$nukcus=array("khh","ｑh","ghh","^x","rhh","Dhh");
		
		$text = str_replace($se, $re, $text);
		
		$text = str_replace($nukcor, $nukcus, $text);
		
		$text=str_replace("a.h","",$text);
		$text=str_replace(".h","",$text);
		$text=str_replace("^khh","K",$text);
		
		
	}

/* R RR lR lRR for vocalic HK encoding */	

	if ($_SESSION['src'] == "hk") {

		$voco=array("lRR","lR","RR");
		$vocn=array("W","w","q");
		
		$text = str_replace($voco,$vocn,$text);
		
		}


/* Replacment for Cologne Tamil  */

	
	if ($_SESSION['src'] == "cologne") 
	{
		$text = str_replace("e", "W", $text);
		$text = str_replace("E", "x", $text);

		$text = str_replace("W", "E", $text);
		$text = str_replace("x", "e", $text);

		$text = str_replace("o", "W", $text);
		$text = str_replace("O", "x", $text);

		$text = str_replace("W", "O", $text);
		$text = str_replace("x", "o", $text);

		$text = str_replace("g", "G", $text);

		$text = str_replace("n^", "J", $text);
		$text = str_replace("jn", "J", $text);

		$text = str_replace("R", "r2", $text);

		$text = str_replace("z", "Z", $text);
	
				
	}   

	if ($_SESSION['src'] == "malayalam") 
	{

		$text = str_replace("ൌ","ൗ",$text); // Arachaic Virama -> Modern Virama (Vowel Marker )
	}  

if ($_SESSION['src'] == "dtamil")  // Replace srI with shrI & remove ZWNJ
{

 $tam_old=array("ஸ்ரீ","க்‌ஷ்","ர‌ி","ர‌ீ","ௐ");
 $tam_new=array("ஶ்ரீ","க்ஷ்","ரி","ரீ","ஓம்ʼ");

 $text = str_replace($tam_old,$tam_new,$text);
 
 $text=str_replace("ம் ̐","ம‌‌‌‌‌‌் ̐",$text);
 
 
	$subnum = array("¹","₁","₂","₃","₄","ஃக‌");
	$supnum = array("","","²","³","⁴","ஃக‌¹");

	$text = str_replace($subnum,$supnum,$text);



}

//Miscelleanious alternate form replacements for Roman Transcription

 { 
	$text = str_replace("ṃ","ṁ",$text);
	$text = str_replace("ḿ","ṁ",$text);
	$text = str_replace("||", "॥", $text);
	$text = str_replace("|", "।", $text);
}

// Strip Bengali Khanda ta 

$text=str_replace("ত্‍","ত্",$text);

$text=str_replace("ৎ","ত্",$text);

// Replace Composite Thai Vowels with sepearate vowel signs )

if ($_SESSION['src'] == "thai") 

{

$thai_old=array("ำ","ึ");
$thai_new=array("าํ","ิํ");

$text=str_replace($thai_old,$thai_new,$text);

}




if ($_SESSION['src'] == "tibetan") 

{

/* Replace precomposed vowels by decomposed vowels as per unicode recommendation */

$vow_IU_new = array("ཱི","ཱུ");
$vow_IU_old = array("ཱི","ཱུ");

$text = str_replace($newvow,$oldvow, $text); 
$text = str_replace($vow_IU_old,$vow_IU_new, $text); 

$text = str_replace($subform,$fulform, $text);

/* Replace Subjoined Forms of Tibetan Consonatns with the Halant based forms */

$tib_sub=array("ྺ","ྻ","ཪ");
$tib_min=array("ྭ","ྱ","ར");

$text = str_replace($tib_sub,$tib_min,$text);

$text=str_replace("་"," ",$text);

$ksha_full=array("ཀྵ","ྐྵ");
$ksha_decom=array("ཀྵ","ྐྵ");

$text=str_replace($ksha_full,$ksha_decom,$text);

/* Replace Stylized Chandrabindu with ordinary Chandrabindu */

 $text = str_replace("ྂ","ྃ", $text); 

}

/* Retain Latin text when converting Indic Scripts */

$latinarr=array("hk","unicode","unicode2","itrans","velthuis","cologne"); 

if (!in_array($_SESSION['src'],$latinarr))
{

$text = dtext($text);

} 

else

{

preg_match_all("/(##.*?##)/",$text,$match);

for($arindex=0 ; $arindex < count($match[0])  ; $arindex++)

{

$text = str_replace($match[0][$arindex],dtext($match[0][$arindex]),$text);

}

$text = preg_replace("/(##)(.*)(##)/","$2",$text);

//print_r($match[0]);

}


$text=$text." ";

//$text=$text." ☸"; // Appending Unicode Sign DharmaChakra - Just for Auspiciousness :) 
		
}



?>