<?PHP

 // Array replacement of Nasalized Unvoiced Consonants with Voiced Counterparts e.g taGkam -> taGgam

	$rep1 = array("Gk","Jc","n2r2","r2r2","mp","n2T","n2p","NT","nt");
	$rep2 = array("Gg","Jj","NDr","Tr","mb","nT","n2b","ND","nd");

	$text = str_replace($rep1,$rep2,$text); 
	
	$konst=array("y","Z","r","N","l","l2");
	$unvoiced=array("k","t","p","c");
	$voiced=array("g","d","b","s");
	
// Replacing Unvoiced consonants followed by pure $konst consonnant with Voiced counterparts e.g Eyta -> Eyda

	foreach($konst as $kon) {

	for($i=0;$i<=3;$i++)

	{
	
	$text=str_replace($kon.$unvoiced[$i],$kon.$voiced[$i],$text);

	}

			     }
	
	$text=preg_replace("/\bc/", "s", $text); // c at word beginning is pronunced as /s/

	$text = str_replace("c s","c c",$text); // ac samayam -> ac camayam
	$text = str_replace("n t","n d",$text);
	
	
	/* Replacing Inter-Vocalic Unvoiced Consonants with Voiced Consonants */

	$vowelss = array("a","A","i","I","u","U","e","E","o","O");
	$conss = array("c","k","T","t","p");
	$conssr = array("s","g","D","d","b");	

	foreach ($vowelss as $vw1)
  {
	foreach ($vowelss as $vw2)	
	{
		for($i=0;$i<=4;$i++)
		{
		  	$t1 = $vw1.$conss[$i].$vw2;
			$t2 = $vw1.$conssr[$i].$vw2;
			$text = str_replace($t1,$t2,$text);
		}
	}	
  }

 // Correcting obvious unwanted sequences that appear due to above replacements 
  
	$text = str_replace("bp","pp",$text);
	$text = str_replace("gk","kk",$text);
	$text = str_replace("dt","tt",$text);

	$text=preg_replace("/g\b/","k",$text);
	$text=preg_replace("/d\b/","t",$text);
	$text=preg_replace("/b\b/","p",$text);


/* Aytham */

 $aytham['k']='g';
 $aytham['t']='d';
 $aytham['T']='D';
 $aytham['c']='s';

	foreach($aytham as $key=>$value)
		{
		      $text=str_replace("K".$key,"g".$value,$text);
		}

	// aKtu -> agdu - g is the modern pronunciation of Aytham as realized by Majority of native speakrs. Thought the original is a Glottal.

?>