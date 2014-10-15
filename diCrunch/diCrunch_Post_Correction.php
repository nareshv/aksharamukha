<?PHP


$text = str_replace("ජ්ඤ","ඥ",$text); // Replace jJa with the Atomic Unicode Characters


if (!empty($_SESSION['taom']))  /*Enabling Tamil OM */

{

    //	$text = preg_replace("/\bஓம்\b/","ௐ",$text);
    $text = preg_replace("/(?<=\s)ஓம்ʼ?(?=\s)/","ௐ",$text);
    $text = preg_replace("/^ஓம்ʼ?/","ௐ",$text);
}

//Replace Devanagari Viramas with Pipes.. for non-devanagari scripts

if ($_SESSION['tgt'] == "malayalam")  /* Chillu Replacement */

{

    $Chillu_dia=array("ണ്ʼ","ന്ʼ","ര്ʼ","ല്ʼ","ള്ʼ","ക്ʼ");
    $text = str_replace($Chillu_dia,$Chillu_zwj,$text);
    $text = str_replace("ന്·","ന്‍·",$text);

}

// Urdu remove Tashdid and Sukun

if ($_SESSION['tgt'] == "urdu" || $_SESSION['tgt'] == "arabic" )

{
    $text = str_replace("ّْ","ّ",$text);

    // Latin Punctuation to Arabic Punctuations

    $text = str_replace(array(",",";","?"),array("،","؛","؟"),$text);

}

if ($_SESSION['haaru'] == 1 )

{
    $withouthaaru = array("ꢥ꣄ꢲ","ꢬ꣄ꢲ","ꢭ꣄ꢲ","ꢪ꣄ꢲ");
    $withhaaru = array("ꢥꢴ","ꢬꢴ","ꢭꢴ","ꢪꢴ");

    $text = str_replace($withouthaaru,$withhaaru,$text);

}

if ($_SESSION['tgt'] == "urdu" && !empty($_SESSION['remshrturd']))

{
    $text = str_replace(array("ِ","َ","ُ","ْ"),"",$text);
}

if ($_SESSION['tgt'] == "urdu" || $_SESSION['tgt'] == "arabic")

{

    $text = str_replace(array("رْ۲","نْ۲"),array("رْ","نْ"),$text);

}

// Telugu dot-Anusvara Combinations


if ($_SESSION['tgt'] == "telugu" && !empty($_SESSION['knukta']) )

{
    $text = str_replace("·ం","·‍ం",$text);
}

if ($_SESSION['removedot'] == 1)

{

    $text = str_replace("·","",$text);

}

if($_SESSION['tgt']!='devanagari')

{

    $text = str_replace("।","|",$text);
    $text = str_replace("॥","||",$text);

}

if (!empty($_SESSION['mtrad'])) // Specific Options for Traditional Malayalam

{

    $text = str_replace("'", "ഽ", $text); // Using Traditional Avagraha

}

if (!empty($_SESSION['replacesha']) && !in_array($_SESSION['tgt'],$latinarr)) /* Using the Tamil Letter sha */

{

    $text = swap($yukta['scr'],array("²"),$text);
    $text = swap(array($v),array("²"),$text);

    $text = str_replace("ஸ²","ஶ",$text);

    $text = swap(array("²"),$yukta['scr'],$text);
    $text = swap(array("²"),array($v),$text);

}

// Removing Extraneious Diacritics from the Text

if (!empty($_SESSION['removedia'])) {

    $diacritic=array("²","³","⁴","·","¬","•","«","¦","°","¿","¨","ʼ","ˇ"," ̐","˘","ˆ");

    foreach($diacritic as $dia)
        $text = str_replace("$dia", "", $text);

    //echo "Inside Loop";

}

// Using Native Avagrahas for the Ext

if (!empty($_SESSION['avagra']))

{

    if ($_SESSION['tgt'] == "telugu") {

        $text = str_replace("'", "ఽ", $text);

    }

    if ($_SESSION['tgt'] == "kannada") {

        $text = str_replace("'", "ಽ", $text);

    }

    if ($_SESSION['tgt'] == "malayalam") {

        $text = str_replace("'", "ഽ", $text);

    }

}

if ($_SESSION['tgt'] == "unicode2") /* ISO encoding */

{
    $text = str_replace("o", "ō", $text);
    $text = str_replace("e", "ē", $text);
    $text = str_replace("ŏ", "o", $text);
    $text = str_replace("ĕ", "e", $text);
}

if (empty($_SESSION['oldbur']) && $_SESSION['tgt']=='burmese') /* Burmese Rearrangments */

{

    $my_old=array("္ယ","္ရ","္ဟ","္ဝ","င္","သ္သ","ဉ္ဉ"); // Old Unicode Conventions
    $my_new=array("ျ","ြ","ှ","ွ","င်္","ဿ","ည"); // New Unicode Conventions

    $tall_cons=array("ခ","ဂ","င","ဒ","ပ","ဝ"); // Replace the Vowel Sign aa with the Tall aa for these cosonants

    foreach($tall_cons as $tc)

    {
        $text=str_replace($tc."ော",$tc."ေါ",$text);
        $text=str_replace($tc."ာ",$tc."ါ",$text);
        $text=str_replace("္".$tc."ါ","္".$tc."ာ",$text);
        $text=str_replace("္".$tc."ေါ","္".$tc."ော",$text);

        $text=str_replace("င္".$tc."ာ","င္".$tc."ါ",$text);
        $text=str_replace("င္".$tc."ော","င္".$tc."ေါ",$text);
    }

    foreach($main['scr'] as $cot)

    {

        if($cot!="ရ" && $cot!="ယ")

        {

            //echo "inside loop";

            $text=str_replace("ဒ္".$cot."ာ","ဒ္".$cot."ါ",$text);
            $text=str_replace("ဒ္".$cot."ော","ဒ္".$cot."ေါ",$text);

        }

    }

    $text = str_replace($my_old,$my_new, $text);

}

if (!empty($_SESSION['oldbur']) && $_SESSION['tgt']=='burmese') //Old Burmese Virama

{

    //echo "insideloop";

    $text=str_replace("်","္",$text);

}

// Khmer Repha

if ($_SESSION['tgt'] == "khmer")

{
    $text = str_replace("រ៑’","៌",$text);

    $text = str_replace("រ៑`","៌",$text);

}

if (!empty($_SESSION['ri'])) /* Unligated Ri/rii in Tamil */

{

    $text = str_replace("ரி","ர‌ி", $text);
    $text = str_replace("ரீ","ர‌ீ", $text);
    $text = str_replace("ர்","ர‌்", $text);

}

if (!empty($_SESSION['mau'])) /* Traditional Form of au */

{

    $text = str_replace("ൗ","ൌ‍",$text);

}

//if (!empty($_SESSION['pchillu']) && $_SESSION['pchillu']==2 )  /* Replace ZWJ based Chillus to Atomic Chillus */

{

    $text = str_replace("‍ം","‍മ്",$text);

    $text = str_replace($Chillu_zwj,$Chillu_atom,$text); // See above for Chillu_zwj

}

if (!empty($_SESSION['ksha'])) /* Virama based Ksha to Conjunct Form */

{

    $text = str_replace("க்ஷ","க்‌ஷ",$text);

}

//if (empty($_SESSION['level1'])) /* Level 1 Conjncts in Sinhala */ //Default Level 1 Conjunct

{

    $text = str_replace("්ර","්‍ර",$text);
    $text = str_replace("්ය","්‍ය",$text);
    $text = str_replace("ක්ෂ","ක්‍ෂ",$text);
    $text = str_replace("ර්‍ය","ර‍්‍ය",$text);

}

if (!empty($_SESSION['level2'])) /*Level 2 to Conjuncts in Sinhala */

{

    $text = str_replace("ර්","ර්‍",$text);
    $text = str_replace("ර්‍‍","ර්‍",$text);

    $text = str_replace("ර‍්‍ය","ර්‍ය",$text);

    $sinh_sing = array("ක්ව","න්ථ","න්ද","න්ධ","ග්ධ","ත්ව‍","ද්ව‍");
    $sinh_conj = array("ක්‍ව‍","න්‍ථ","න්‍ද","න්‍ධ","ග්‍ධ","ත්‍ව","ඳ්‍ව");

    $text = str_replace($sinh_sing,$sinh_conj,$text);

}

if ($_SESSION['tgt'] == "cologne") {
    $text = str_replace("e", "W", $text);
    $text = str_replace("E", "x", $text);

    $text = str_replace("W", "E", $text);
    $text = str_replace("x", "e", $text);

    $text = str_replace("o", "W", $text);
    $text = str_replace("O", "x", $text);

    $text = str_replace("W", "O", $text);
    $text = str_replace("x", "o", $text);

    $text = str_replace("G", "g", $text);

    $text = str_replace("J", "nj", $text);

    $text = str_replace("r2", "R", $text);

    $text = str_replace("Z", "z", $text);

}

if ($_SESSION['tgt'] == "tibetan") /* Replace Virma forms of the Consonants with Subjoined Forms */

{

    $text = str_replace($fulform,$subform, $text);
    $text = str_replace($oldvow,$newvow, $text);

    $tib_sub=array("ཝྭ","ཡྱ","རྱ","རྭ");
    $tib_min=array("ཝྺ","ཡྻ","ཪྻ","ཪྻ");

    $text = str_replace($tib_sub,$tib_min,$text);

    $text = preg_replace("/\ +/","་", $text);

}

if (!empty($_SESSION['vaba'])) /* Tibetan Wa to Tibetan Ba */

{

    $text = str_replace("ཝ","བ",$text);
    $text = str_replace("རྭ","རྦ",$text);

}

if (!empty($_SESSION['wava']) && $_SESSION['wava'] == 1) /* Oriya Wa to Ba */

{

    $text = str_replace("ୱ","ବ",$text);

}

if (!empty($_SESSION['vabab']) ) /* Bengali Wa to Ba */

{

    $text = str_replace("ৱ","ব",$text);

}

if (!empty($_SESSION['wava']) && $_SESSION['wava'] == 2) /* Oriya Wa to Va */

{

    $text = str_replace("ୱ","ଵ",$text);

}

if (empty($_SESSION['spac'])) /* Tibetan Tshag to Spce */

{

    $text = str_replace("་"," ",$text);

}

if (!empty($_SESSION['virem'])) /* Remove Tibetan Virama */

{

    $text = str_replace("྄","",$text);

}

if (!empty($_SESSION['stanu']))  /* Tibetan Chandrabindu with Nada */

{

    $text = str_replace("ྃ","ྂ",$text);

}

if (empty($_SESSION['yaphala']))  /* YYA phala instead of Ya for Oriya */

{

    $text = str_replace("୍ଯ","୍ୟ",$text);

}

if (!empty($_SESSION['normra'])) // Normal Subjoined Ra

{

    $text = str_replace("ཪ","ར",$text);

}

if ($_SESSION['tgt'] == "thai") // Replace seperate vowels signs with Composite Signs

{

    $text = str_replace("าํ","ำ",$text);
    $text = str_replace("ิํ","ึ",$text);

    $text = str_replace("เ’","เ",$text);
    $text = str_replace("โ’","โ",$text);
    $text = str_replace("ไ’","ไ",$text);

}

if ($_SESSION['tgt'] == "bengali" || $_SESSION['tgt'] == "assamese" ) // remove khanda ta in bhakt etc

{

    $text = str_replace("্ৎ","্ত্",$text);

}

if ($_SESSION['tgt'] == "thai" && !empty($_SESSION['shorta'])) /* Add Short a for Thai */

{

    $text = str_replace("ฺ","",$text); // Removing Explicit Virama

}

if ($_SESSION['tgt'] == "punjabi" && !empty($_SESSION['guruvisarg'])) // Gurmukhi Visargna

{

    $text = str_replace(":","ਃ",$text);

}

if ($_SESSION['tgt'] == "tamil-grantha")  /* Use Tamil Vowel Markers for Tamil Letters, and Vice Versa for Grantha */

{
    $granthalet=array("খ","গ","ঘ","ছ","জ","ঝ","ঠ","ড","ঢ","থ","দ","ধ","ফ","ব","ভ","শ","ய়","খ়","গ়","জ়","ড়","ঢ়","க়");

    $tamiloldlet1=array("ண","ன","ற");

    $tamiloldlet2=array("ண","ன","ல","ள");

    foreach ($tamiloldlet1 as $tol) {
        $text=str_replace($tol."ா",$tol."‍ா",$text);
        $text=str_replace($tol."ொ","‌‍‌ெ".$tol."‌ா",$text);
        $text=str_replace($tol."ோ","‌‍‌ே".$tol."‌ா",$text);
}

foreach ($tamiloldlet2 as $tol) {

    $text=str_replace($tol."ை","‌‍‌ை".$tol,$text);

}

foreach ($granthalet as $gl) {
    $text=str_replace($gl."ி",$gl."ি",$text);
    $text=str_replace($gl."ீ",$gl."ী",$text);
    $text=str_replace($gl."ை","‌‍‌ை".$gl,$text);
    $text=str_replace($gl."ெ","‌‍‌ெ".$gl,$text);
    $text=str_replace($gl."ே","‌‍‌ே".$gl,$text);
    $text=str_replace($gl."ொ","‌‍‌ெ".$gl."ா",$text);
    $text=str_replace($gl."ோ","‌‍‌ே".$gl."ா",$text);
    $text=str_replace($gl."ௌ","ெ".$gl."ௗ",$text);
    $text=str_replace("শ்ரீ","",$text);
}

}

if ($_SESSION['tgt'] == "egrantha")  /* Short Vowels for Grantha */

{

    $text=swap_ey($main['scr'],array(""),$text);

    foreach ($main['scr'] as $gr) {

        $text=str_replace($gr."","".$gr."া",$text);

}

$text=str_replace("়্","়্‌",$text);    // Avoid Conjuncts with Nukta
}

// Mark Varga 1 letteers

if ($_SESSION['tavarga1'] == 1 && $_SESSION['tgt'] == 'dtamil')

{

    $vargalet = array("க","ச","ட","த","ப","ஜ");

    foreach($vargalet as $varg)

    {
        $text = str_replace($varg,$varg."¹",$text); //todo

        // Reverse Paris K1a -> Ka1

        $text = swap($SuperNumeral,array($v),$text);
        $text = swap($SuperNumeral,$yukta['scr'],$text);
        $text = swap($SuperNumeralNM,array($main['scr']['149'],$main['scr']['151']),$text);

        // correct 12, 13, 14 combinations

        $doublenum = array("¹²","¹³","¹⁴");
        $singlenum = array("²","³","⁴");

        $text=str_replace($doublenum,$singlenum,$text);

}

}

//Tamil Subscripts

if ($_SESSION['tasub'] == 1 && $_SESSION['tgt'] == 'dtamil')

{

    $superscr = array("¹","²","³","⁴");
    $subscr = array("₁","₂","₃","₄");

    $text=str_replace($superscr,$subscr,$text);

}

// Remove Diacritics from latin encodings

if (in_array($_SESSION['tgt'],$latinarr) || $_SESSION['tgt']=='urdu' ) {

    $text = str_replace("ʼ","",$text);

}

// Miscallaeneous Replacement for Roman

if ($_SESSION['tgt'] == "itrans") {
    $text = str_replace("~%N","~N", $text);
    $text = str_replace(".NN","~N", $text);
    $text = str_replace(".Nn","~n", $text);

    $text=str_replace(array("ch","c","^Ｒ","^L","a^e","R^i^I"),array("Ch","ch","R","L","a.c","R^I"),$text);

    $nukcor=array("K","q","G","J",".Dh",".D");
    $nukcus=array("khh","ｑh","ghh","^x","rhh","Dhh");

    $text = str_replace($nukcus,$nukcor,  $text);
}

if ($_SESSION['tgt'] == "velthuis") {
    $text = str_replace("k.Nn","~n", $text);
    $text = str_replace("~mn","~n", $text);

}

$text = str_replace("ｑ", "q", $text);
$text = str_replace("ż", "z", $text);

if ($_SESSION['tgt'] == "hk" || $_SESSION['tgt'] == "cologne") {
    $text = str_replace(array("q","w","W"),array("RR","lR","lRR"), $text);
    $text = str_replace("RRh","qh", $text);
}

if ($_SESSION['tgt'] == "velthuis") {
    $text = str_replace(".rrh","qh", $text);
}

if ($_SESSION['tgt'] == "dtamil") {

    $text=str_replace("ஂˆ","்ˆ",$text);

}

if ($_SESSION['tgt'] == "kannada") {
    $text = str_replace("಼್","಼್‌",$text);
}

if ($_SESSION['tgt'] == "thai" ||  $_SESSION['tgt'] == "tibetan" || $_SESSION['tgt'] == "burmese" || $_SESSION['tgt'] == "khmer") {
    $text = str_replace("‌","",$text);
}

/* Restore Latin Letters */

$text = str_replace($carray,$larray, $text);
$text = str_replace($carray2,$larray2, $text);

$text=str_replace("☸","",$text); // Removing the appended DharmaChakra

/* Tamil Anusvara and Chandrabindu */

$text=str_replace("ம‌‌்","ம்",$text);
$text=str_replace("ம‌‌‌‌‌‌் ̐","ம் ̐",$text);

/* Malayalam Chillu */

$text=str_replace("്ʼ","്‍",$text);

$text=str_replace("ஸ்²ரீ","ஸ்ரீ",$text);
