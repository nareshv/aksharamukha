<?php

/* Replace Decomposed Nukta Characters by pre-composed Nukta consonants */

/* Add Oriya Nukta Characters & Tibetan Vowels.. */

$nukt_decom = array("क़","ख़","ग़","ज़","ड़","ढ़","फ़","य़","ਲ਼","ਸ਼","ਖ਼","ਗ਼","ਜ਼","ਫ਼","ড়","ঢ়","য়","ଡ଼","ଢ଼"); // Decomposed Nukta Consonants 

$nukt_precom = array("क़","ख़","ग़","ज़","ड़","ढ़","फ़","य़","ਲ਼","ਸ਼","ਖ਼","ਗ਼","ਜ਼","ਫ਼","ড়","ঢ়","য়","ଡ଼","ଢ଼"); // Precomposed Nukta Consonants

//if(!empty($_POST['src']))

{

if($_SESSION['src'] != 'egrantha' && $_SESSION['src'] != 'tamil-grantha' )

{

$text = str_replace($nukt_decom,$nukt_precom,$text);

}

}

/* underscore characters */

$dev_under=array("ॻ","ॼ","ॾ","ॿ");
$dev_anu=array("ग॒","ज॒","ड॒","ब॒");

$text = str_replace($dev_under,$dev_anu,$text);

/* Tibetan Vowels */

/* Tibetan Vowels & Ksha */

// Check preprocess.php

/* Thai Composite AM */

$text=str_replace("ํา","ำ",$text);

/* Decomposed Latin Diacrtics to Precomposed one */

$latindec = array("ā","ī","ū","ē","ō","ṃ","ṁ","ḥ","ś","ṣ","ṇ","ṛ","ṝ","ḷ","ḹ","ḻ","ṉ","ṟ");
$latinpre = array("ā","ī","ū","ē","ō","ṃ","ṁ","ḥ","ś","ṣ","ṇ","ṛ","ṝ","ḷ","ḹ","ḻ","ṉ","ṟ");

$text = str_replace($latindec,$latinpre,$text);

?>