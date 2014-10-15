<?PHP 
/* Swap diacritic numerals & the vowel sign pairs */

/* e.g கீ²  -->  க²ீ */

$text = swap(array($main['scr']['149'],$main['scr']['151']),$SuperNumeralNM,$text);

 $text = swap($yukta['scr'],$SuperNumeral,$text);

 $text = swap(array($v,$main['scr'][149]),$SuperNumeral,$text);	
 
 
/* Replace Khmer Repha with Pure consonant r preceding the consonant  dhamRa -> dharma */

if ($_SESSION['src'] == "khmer") 

{
 	$text = swap_ey($main['scr'],array("៌"),$text); 
	$text = str_replace("៌","រ្",$text); 

}

/* Swap Vowel Signs in Thai for E, ai, o eY to ye (e.g) เย -> ยเ   */ 

if ($_SESSION['src'] == "thai" )
{

$vowthai = array("โ","ไ","เ"); 

foreach($main['scr'] as $constthai)

{

  foreach($vowthai as $vowelsthai)

   {

	$text = str_replace($vowelsthai.$constthai."ฺ",$constthai."ฺ".$vowelsthai,$text);
    
   }

}

$text = swap_ex($vowthai,$main['scr'],$text);



}

// Replace Haaru to h

$text = str_replace("ꢴ","꣄ꢲ",$text);


/* Grantha Replace - Replace and Rearrange Tamil & Grantha Characters : Revert all the changes made in Post_Correct for Grantha */

if ($_SESSION['src'] == "tamil-grantha")  

 {
 
	$text=str_replace("়্‌","়্",$text);	// Reverting : Avoid Conjuncts with Nukta
 
	$granthalet=array("খ","গ","ঘ","ছ","জ","ঝ","ঠ","ড","ঢ","থ","দ","ধ","ফ","ব","ভ","শ","ய়","খ়","গ়","জ়","ড়","ঢ়","க়");

	$tamiloldlet1=array("ண","ன","ற");
	
	$tamiloldlet2=array("ண","ன","ல","ள");

	foreach($tamiloldlet1 as $tol)
	{
        $text=str_replace($tol."‍ா",$tol."ா",$text);
	    $text=str_replace("‌‌ெ".$tol."‌ா",$tol."ொ",$text);
	    $text=str_replace("‌‌ே".$tol."‌ா",$tol."ோ",$text);
	}

	foreach($tamiloldlet2 as $tol)
	{
	
	   $text=str_replace("‌‌ை".$tol,$tol."ை",$text);

	}
	
		
    foreach($granthalet as $gl)
	{
        $text=str_replace("‌‍‌ெ".$gl."ா",$gl."ொ",$text);
		$text=str_replace($gl."ি",$gl."ி",$text);
	    $text=str_replace($gl."ী",$gl."ீ",$text);
	    $text=str_replace("‌‌ை".$gl,$gl."ை",$text);
	    $text=str_replace("‌‌ே".$gl."ா",$gl."ோ",$text);
	    $text=str_replace("‌‌ே".$gl,$gl."ே",$text);
	    $text=str_replace("ெ".$gl."ௗ",$gl."ௌ",$text);
		$text=str_replace("‌‌ெ".$gl,$gl."ெ",$text);
	    $text=str_replace("","শ்ரீ",$text);  
		$text = str_replace("ொ","ொ",$text);
	}
 }
?>