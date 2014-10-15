<?PHP

/* Exceptions postprocessing */

if (!empty($_SESSION['src'])) {

		
	/* ITRANS: Evading double replacements
		- the long vowel issue with R^I and L^I
		- the _D XIAST extension */
	
	if ($_SESSION['src'] == "itrans") {
		$se = array("L^{$ch[$_SESSION['tgt']]['2']}", "R^{$ch[$_SESSION['tgt']]['2']}", ".{$ch[$_SESSION['tgt']]['9']}");
		$re = array($ch[$_SESSION['tgt']]['16'], $ch[$_SESSION['tgt']]['5'], $ch[$_SESSION['tgt']]['20']);
		$text = str_replace($se, $re, $text);
	}	
		

}

if ($_SESSION['src'] == "unicode2") // ISO Conventions
            {	
	$text = str_replace("o", "O", $text);
	$text = str_replace("e", "E", $text);
	$text = str_replace("ō", "o", $text);
	$text = str_replace("ē", "e", $text);
	}

if ($_SESSION['src'] == "unicode2" && $_SESSION['tgt'] == "unicode") // ISO Conventions
            {	
	$text = str_replace("O", "ŏ", $text);
	$text = str_replace("E", "ĕ", $text);
	}

//	$text = str_replace(".%N  ‍","~", $text);

$text = str_replace("\n ", "\n", $text); // Replace full width q by ordiary q

/* Overcome Danda issues */

$text = str_replace("।","|",$text);
$text = str_replace("॥","||",$text);


/* Preference postprocess */

/* Process escape character */

function conv_back($char) {
	global $ch;
	$id = array_search($char, $ch[$_SESSION['tgt']]);
	if ($id > 0) {
		$char = $ch[$_SESSION['src']][$id];
	}
	return $char;
}


$text = preg_replace("@#(.)@ue", "conv_back('\\1')", $text); 


?>