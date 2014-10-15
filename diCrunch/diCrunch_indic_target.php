<?PHP

	/* If an Indic script is the target */

/* Replace oM with oM glyph */

//$text = preg_replace("/(\W?)(o~)(\W)/","$1".$vow['scr'][267]."$3", $text); // o with candrabindu
$text = preg_replace("/\boM\b/",$vow['scr'][267], $text); // o with anusvara
$text = preg_replace("/\bo~(?<!\b)/",$vow['scr'][267], $text); // o with anusvara

/* Move Dandas */

$text = preg_replace("/(\|?)(\|)/","$1$2 ","$text");

	$yukta['scr'][301] = "";

	$text = " " . $text;
	$text = str_replace("-", "- ", $text); // Ensure full vowel is given after dash
	$text = str_replace("^", "", $text); // Remove external sandhi break
	$text = str_replace("%", "", $text); // Remove XHK capital letter sign
	
	/* Create half-consonants */
	
	$half['tra'] = array();
	$half['scr'] = array();
	
	foreach ($main['tra'] as $key => $val) {
		$half['tra'][$key] = str_replace("a", "", $val);
	}
	foreach ($main['scr'] as $key => $val) {
		$half['scr'][$key] = $val . $v;
	}
		
	
	/* Crunch joint vowels */
	
	foreach ($yukta['tra'] as $key => $val) {
		foreach ($half['tra'] as $hkey => $hval) {
			$obj = str_replace("{$v}", "", $half['scr'][$hkey]);
			$text = str_replace(($hval . $val),  ($obj . $yukta['scr'][$key]), $text);
		}
	}

	$text = str_replace("_", "_ ", $text); // For ha_uk etc.


	$text = str_replace ($main['tra'], $main['scr'], $text);
	$text = str_replace ($vow['tra'], $vow['scr'], $text);
	$text = str_replace ($half['tra'], $half['scr'], $text);
	$text = str_replace ($num['tra'], $num['scr'], " " . $text . " ");

	$text = str_replace($v.$main['scr'][154],$main['scr'][154], $text); // Fix nuktas

	/* Crunch remaining full vowels, e.g. ha_uk  and sei */

	foreach ($vow['tra'] as $key => $val) {
		$objscr = str_replace(" ", "", $val);
		$objtra = str_replace(" ", "", $vow['scr'][$key]);
		$text = str_replace("{$objscr}", "{$objtra}",  $text);
	}

	$tidys = array("_ ", "- ", "\n ");
	$tidyr = array("", "-", "\n");

	$text = trim(str_replace($tidys, $tidyr, $text));

/* Add an Extra New line at the End */

$text=$text."\n";

/* Correct the Virama that appears with quoted Avagraha */

$text = str_replace("'".$v,"'",$text);

 /* Swap diacritic numerals & the vowel sign pairs */

/* e.g கீ² <-- க²ீ */

$text = swap($SuperNumeral,array($v),$text); 
$text = swap($SuperNumeral,$yukta['scr'],$text);
$text = swap($SuperNumeralNM,array($main['scr']['149'],$main['scr']['151']),$text);

/* Correct  న·ం misplacements using ZWJ */

/* Reverse Swap...  The Anusvara & Chandrabindu Parts */

if($_SESSION['tgt'] == "dtamil")

$text = swap(array($main['scr']['149'],$main['scr']['151']),$SuperNumeral,$text);

/* Swap Vowel Signs in Thai for E, ai, o eY to ye ยเ -> เย */


if ($_SESSION['tgt'] == "thai")
{
$text = swap_ey($main['scr'],array($yukta['scr']['311'],$yukta['scr']['312'],$yukta['scr']['313']),$text);

}
?>