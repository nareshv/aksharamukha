<?PHP

//Tibetan correctoin

$text=str_replace(array("Aི","Aུ"),array("I","U"),$text);

$northscript = array("devanagari","bengali","gujarati","oriya","assamese");

if (!empty($_SESSION['finala']) && in_array($_SESSION['src'],$northscript)) // Removing Word Final /a/

{

    $text=preg_replace("@(\b[kgGcjJLTDNfqtdnpbmLyrlvzsShZ]*h*)a(?<=\b)@","$1!!#",$text);

    $text=preg_replace("/(\b|[aAiIuUeEoORM~][kgGcfqjJLhTDNtdnpbmM~LyrlvzsSZ]h*)(a)([kgGcjJLTfqDNtdhnpbmLyrlvzsSZ]h*[AiIuUeEoOR])(M|~)?(?<=\b)/","$1$3$4",$text);

    $text=preg_replace("/([aAiIuUeEoORM~][kgGfqcjJLTDNhtdnpbmM~LyrlvzsSZ]h*)(a)([kgGcjfqJLTDhNtdnpbmLyrlvzsSZ]h*[aAiIuUeEoORM~])([kgGcjJLTfqDNtdnpbhmLyrlvzsSZ]h*[aAiIuUeEoOR])(M|~)?(?<=\b)/","$1$3$4$5",$text);

    $text=preg_replace("/(?<![aAiIuUeEoO])a\b/","",$text);

    $text=preg_replace("/(~[kgGcjJLTDNfqtdnpbmLyrlvzsShZ]*h*)(!!#)/","$1",$text);
    $text=str_replace("!!#","a",$text);

}

if ($_SESSION['tgt']=='malayalam' && (empty($_SESSION['pchillu']) || $_SESSION['pchillu']==2 ) ) /* Word Final Chillus in Malayalam */

{

    if(!empty($_SESSION['mtrad'])) // Traditional Malayalam Orthography

    {
        $text = preg_replace("/([rlL])\b/", "$1‍", $text);
    } else

    {

        $text = preg_replace("/([rlL])(?![aAiIuoOUeERqwrvylL2])/", "$1‍", $text);

        $text = str_replace("rv","r‍v",$text);

        $text = str_replace("rl","r‍l",$text);

    }

    $text = preg_replace("/([n])(?![2aAiIuoOUeERqwntdmyrlv])/", "$1‍", $text);

    $text = preg_replace("/([N])(?![aAiIuoOUeERqwNTDmyrlv2])/", "$1‍", $text);

    $text = preg_replace("/(?<=[kgGcjJTDNtdnpbmyrlvzsSh])([nNrlL])‍/", "$1", $text); //ZWJ is remove keshtra -> kshetR chillu -> kshetr-virama

    $text = str_replace("r‍hh","rhh",$text);

}

// Replace n-ZWJ with n-symbol for chillus

if($_SESSION['tgt']=='bengali' && empty($_SESSION['remkhata']))

{

    $text = preg_replace("/([t])(?![aAiIuoOUeERtnbmyrh])/", "ৎ", $text);

}

if($_SESSION['tgt']=='assamese' && empty($_SESSION['aremkhata']) )

{

    $text = preg_replace("/([t])(?![aAiIuoOUeERtnbmyrh])/","ৎ", $text);  // Khanda Ta


}

if ($_SESSION['tgt']!='malayalam')

{

    $text = preg_replace("/([nNlLrk])‍/","$1ʼ", $text); // Introduce Chillu Marking Character

}

if(!empty($_SESSION['transtext'])) // Remove Special Characters for Chillu & YYA

{

    $text = str_replace("¦","",$text);

    $text = str_replace("Y","y",$text);

}

$text = str_replace(array("ruʼ","rUʼ","luʼ","lUʼ","mʼ"),array("R","q","w","W","M"),$text); // For Tamil & Punjabi RR,


if (!empty($_SESSION['transc']) && $_SESSION['src'] == "dtamil") // Tamil Transcription

{

    include "tamil_transcription.php";

}

if ($_SESSION['tgt'] == "dtamil" && !empty($_SESSION['nna']))  /*Replace na with n2a except for word beginnings */

{
    $text = str_replace("n","n2",$text);
    $text = preg_replace("/\bn2/","n",$text);
    $text = preg_replace("@n2([td])@","n$1",$text);
    $text = str_replace("n2n","n2n2",$text);
    $text = str_replace("n22","n2",$text);
}

if (!empty($_SESSION['melanu']) && $_SESSION['melanu']==2) // Nasalized Consonants into Anuvasara

{

    $text = preg_replace("/(?<!')G(?=[kg])/","M",$text);
    $text = preg_replace("/(?<!')J(?=[cj])/","M",$text);
    $text = preg_replace("/(?<!')n(?=[td])/","M",$text);
    $text = preg_replace("/(?<!')N(?=[TD])/","M",$text);
    $text = preg_replace("/(?<!')m(?=[bp])/","M",$text);

}

if (!empty($_SESSION['melanu']) && $_SESSION['melanu']==1) /* Anusvara into Nasalization */

{

    $text = preg_replace("/[~M](?=[kg])/","G",$text);
    $text = preg_replace("/[~M](?=[cj])/","J",$text);
    $text = preg_replace("/[~M](?=[td])/","n",$text);
    $text = preg_replace("/[~M](?=[TD])/","N",$text);
    $text = preg_replace("/[~M](?=[pb])/","m",$text);
    //	$text = preg_replace("/[~M]\b/","m",$text);
}

if ($_SESSION['src'] == "punjabi") /* Addak into Geminate Consonant */

{

    //$text=preg_replace("/M​(?=[nm])/","X",$text); // Has ZWS

    $text = preg_replace("/(X)(\w2?)/","$2$2",$text);  // check with r2 & l2 ?


}

if ($_SESSION['src'] == "sinhala" && !empty($_SESSION['santextag']) ) // Sanskrit/Pali  Tagged Sinhala Source Text

{

    $text = str_replace("O","o",$text);
    $text = str_replace("E","e",$text);

}

if ($_SESSION['tgt'] == "punjabi") /* Correct placement of Tippi & Bindi */

{

    $text = preg_replace("/([ai])M/","$1ੰ",$text);
    $text = preg_replace("/(?<=\w[uU])M/","ੰ",$text);

}

if ($_SESSION['tgt'] == "punjabi" && empty($_SESSION['disaddak'])) /* Double Consonant into Addak */

{
    $text = preg_replace("/([a-zA-Z]2?)\\1/","X$1",$text);

    $text=preg_replace("/X(?=[nm])/","ੰ",$text); // Has ZWJ

    $text=preg_replace("/([kDgr])Xh/","$1hh",$text);

}

if ($_SESSION['tgt'] == "urdu") /* Double Consonant into Tashdid */

{
    $text = preg_replace("/([a-zA-Z]2?)\\1(h)/","$1XC",$text);

    $text = preg_replace("/([a-zA-Z]2?)\\1/","$1X",$text);

    /// rpleace aE AE aO with e e o

    $text =str_replace(array("aE","AE","aO"),array("e","e","A"),$text);

    // include other puncutations // included in the post prcess

    $text=preg_replace("/([kDgr])hX/","$1hh",$text);

    $text = preg_replace("/a(?![iu])/","aَ",$text);

    $text = preg_replace("/(?<!i)(e)(\W)/","aV$2",$text);
    $text = preg_replace("/(?<!i)(E)(\W)/","aV$2",$text);

    $text = preg_replace("/(ai)(\W)/","aَV$2",$text);

}

if ($_SESSION['tgt'] == "arabic") /* Double Consonant into Tashdid */

{
    $text = preg_replace("/([a-zA-Z]2?)\\1(h)/","$1XC",$text);

    $text = preg_replace("/([a-zA-Z]2?)\\1/","$1X",$text);

    // include other puncutations

    $text=preg_replace("/([kDgr])hX/","$1hh",$text);

    $text = preg_replace("/a(?![iu])/","aَ",$text);

}

if ($_SESSION['tgt'] == "thai")

{

    $text = preg_replace("/(?<=\b)([kgGcjJTDNtdnpbmyrlvzsShL]h?)([kgGcjJTDNtdnpbmyrlvzsShL]h?)([eo])/","`$3$1$2a",$text);
    $text = preg_replace("/(?<=\b)([kgGcjJTDNtdnpbmyrlvzsShL]h?)([kgGcjJTDNtdnpbmyrlvzsShL]h?)(ai)/","`$3$1$2a",$text);
    $text = preg_replace("/(?<=\b)([kgGcjJTDNtdnpbmyrlvzsShL]h?)([kgGcjJTDNtdnpbmyrlvzsShL]h?)(au)/","`e$1$2A",$text);

    $text = preg_replace("/([kgGcjJTDNtdnpbmyrlvzsShL]h?)([yrlv])([eo])/","`$3$1$2a",$text);
    $text = preg_replace("/([kgGcjJTDNtdnpbmyrlvzsShL]h?)([yrlv])(ai)/","`$3$1$2a",$text);
    $text = preg_replace("/([kgGcjJTDNtdnpbmyrlvzsShL]h?)([yrlv])(au)/","`e$1$2A",$text);

    $text = preg_replace("/([GJNnmyrlLv])(h)([eo])/","`$3$1$2a",$text);
    $text = preg_replace("/([GJNnmyrlLv])(h)(ai)/","`$3$1$2a",$text);
    $text = preg_replace("/([GJNnmyrlLv])(h)(au)/","`e$1$2A",$text);

    $text = preg_replace("/([sh])([kgGcjJTDNtdnpbmyrlvzsShL]h?)([eo])/","`$3$1$2a",$text);
    $text = preg_replace("/([sh])([kgGcjJTDNtdnpbmyrlvzsShL]h?)(ai)/","`$3$1$2a",$text);
    $text = preg_replace("/([sh])([kgGcjJTDNtdnpbmyrlvzsShL]h?)(au)/","`e$1$2A",$text);

}

if ($_SESSION['tgt'] == "thai" && !empty($_SESSION['shorta'])) /* Add Short a for Thai */

{

    $text = str_replace("M","G",$text);

    $text = preg_replace("/a(?![iu])([kgGcjJTDNtdnpbmyrlvzsZSLh])([kgGcjJZTDNtdnpbmyrlvzsSL])/","aั$1$2",$text);
    $text = preg_replace("/a(?![iu])/","aะ",$text);
    $text = str_replace("aะั","aั",$text);
    $text = str_replace("ะG","ัG",$text);
    $text = str_replace("aะM","aMะ",$text);
}

if (!empty($_SESSION['finalm'])) // Word Final m with Anusvara

{

    $text=preg_replace("/([^kgGcjJTDNtdnpbmyrlvzsZSLh]h?)m\b/","$1M",$text);

    if ( $_SESSION['tgt'] == "malayalam" )

    {
        $text=str_replace("Mp","mp",$text);
        $text=str_replace("Gg","Mg",$text);
        $text=str_replace("mb","Mb",$text);
        $text=str_replace("mph","Mph",$text);
        $text=str_replace("Gkh","Mkh",$text);
        $text=str_replace("Jjh","Mjh",$text);

}

}

if ( $_SESSION['tgt'] == "bengali" && (!empty($_SESSION['conyab']) && $_SESSION['conyab']==1 ) ) // Bengali Ya & YYA conventions

{

    $text = preg_replace("/(?<=[aAiIuUeEoORqwW])y/","Y",$text);

}

if ($_SESSION['tgt'] == "bengali" && (!empty($_SESSION['conyab']) && $_SESSION['conyab']==2 ) ) // ISCII conventions for Bengali

{
    $text = str_replace("Y","X",$text);
    $text = str_replace("y","Y",$text);
    $text = str_replace("X","y",$text);
}

if ( $_SESSION['tgt'] == "assamese" && (!empty($_SESSION['aconyab']) && $_SESSION['aconyab']==1 ) ) // Bengali Ya & YYA conventions

{

    $text = preg_replace("/(?<=[aAiIuUeEoORqwW])y/","Y",$text);

}

if ($_SESSION['tgt'] == "assamese" && (!empty($_SESSION['aconyab']) && $_SESSION['aconyab']==2 ) ) // ISCII conventions for Bengali

{
    $text = str_replace("Y","X",$text);
    $text = str_replace("y","Y",$text);
    $text = str_replace("X","y",$text);
}

if ($_SESSION['tgt'] == "oriya" && !empty($_SESSION['yayya']) && $_SESSION['yayya'] == 1)  /* Contextual Ya for Oriya */

{

    $text = preg_replace("/([^yrlLvSzshZ]h?)([aAiIuUeEoORqwW])y(?<!\b)/","$1$2Y",$text);

}

if ($_SESSION['tgt'] == "oriya" && !empty($_SESSION['yayya']) && $_SESSION['yayya'] == 2)  /* ISCII Ya/Ya convention */

{

    $text = str_replace("Y","X",$text);
    $text = str_replace("y","Y",$text);
    $text = str_replace("X","y",$text);

}

if ($_SESSION['tgt'] == "sinhala" && !empty($_SESSION['sanpali']) ) // Sanskrit/Pali Tagged Sinhala Text

{

    /* Replace Long e and long o with short e and short o as per Sanskrit/Pali Conventions */

    $text = str_replace("o","O",$text);
    $text = str_replace("e","E",$text);
}

if ($_SESSION['tgt'] == "khmer" )

{

    /* Initial steps for placing Khmer Repha : Later steps in Post_correction*/

    $text = preg_replace("/(?<=[aAiIuUoeRqw])r([kgGcjJLTDNtdnpbmLyrlvzsShZ])([kgGcjJTDNtdLnpbLmyrlvzsShZ])/","$1ar`្$2",$text);
    $text = preg_replace("/(?<=[aAiIuUoeRqw])r([kgGcjJLTDNtdnpbmyLrlvzsShZ])/","$1ar`",$text);

    $text=preg_replace("/([kgGcjJTDNtdnLpbmyrlvzsShLZ])(?=\W)/","$1a៑",$text); // Explicit Virama
    $text=preg_replace("/([kgGcjJTDNtdnpbmyrlvzLsShZ])(?=\s)/","$1a៑",$text); // Explicit Virama
}

if ($_SESSION['tgt'] == "burmese" ) // Introduce Explicit Viramas for Burmese Script

{
    $text=preg_replace("/([kgGcjJTDNtdnpbmyrlvzLsShZ])(?=\W)/","$1a်",$text);
    $text=preg_replace("/($[kgGcjJTDNtdnpbmyrlvzLsShZ])/","$1a်",$text);
}

if ($_SESSION['tgt'] == "sinhala" && !empty($_SESSION['level2'])) // Level 2 Conjuncts Sinhala

{
    $text = preg_replace("/(?<=[aAiIuUoeRqw])r([kgGcjJTDNtdnpbmyrlvzsShLZ])/","r‍$1",$text); //Attach ZWJ after r
}

if (!empty($_SESSION['knukta'])) /* Remove Kannada Nukta*/

{

    $text = preg_replace("/([aAiIuUeEoOrqwW])‧/","಼$1",$text);

}

$text = $text." ";
