<?PHP

//echo $_SERVER['HTTP_USER_AGENT'];

// Roman Transliteration Conventions

$ch['hk'] = array(

30 => "AE", // AE
31 => "aE", // ae
29 => "aO", // ae

32 => "*g", // 
33 => "*j", //
34 => "*D", // 
35 => "*d", // 
36 => "*b", //

37 => "qh", // 
38 => "khh", // 
39 => "ghh", // 

42 => "rhh", // 
41 => "Dhh", // 
43 => "Q", // 
44 => "%w%", // .l
45 => "%W%", // _.l

50 => "%%D%%", // _D
51 => "Y", // .Y

70 => "Z",
71 => "L",
72 => "r2",
73 => "n2",


1 => "A", // _a
2 => "I", // _i
3 => "U", // _u
16 => "W", // _.l
15 => "w", // .l
5 => "q", // _.r
4 => "R", // .r
6 => "G", // 'n
7 => "J", // ~n
8 => "T", // .t
9 => "D", // .d 
10 => "N", // .n
11 => "z", // 's
12 => "S", // .s
13 => "M", // 'm (anusvara)
14 => "H", // .h (visarga)
40 => "x",

20 => "D", // _d
21 => "Y", // .y

60 => "~", // \-/ (candrabindu)
61 => "_", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "32wer34we98", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "@", // abbreviation
67 => "`", // Latin apostrophe

68 => "E", // 
69 => "O", // 



74 => "K",



);


$ch['itrans'] = array(

30 => "^ea", // 
31 => "^ae", // 
29 => "^ao", // ae

32 => "*g", // 
33 => "*j", // 
34 => "*D", // 
35 => "*d", // 
36 => "*b", // 

37 => "ｑh", // 
38 => "khh", // 
39 => "ghh", // 

42 => "rhh", // 
41 => "Dhh", // 
43 => "Q", // 
44 => "%%L^i", // .l
45 => "%%L^I", // _.l

50 => "KJK", // _D
51 => "Y", // .Y

70 => "^Z",
71 => "^L",
72 => "^Ｒ",
73 => "^n",


1 => "A", // _a
2 => "I", // _i
3 => "U", // _u
16 => "L^I", // _.l
15 => "L^i", // .l
5 => "R^I", // _.r
4 => "R^i", // .r
6 => "~N", // 'n
7 => "~n", // ~n
8 => "T", // .t
9 => "D", // .d 
10 => "N", // .n
11 => "sh", // 's
12 => "Sh", // .s
13 => "M", // 'm (anusvara)
14 => "H", // .h (visarga) (visarga)
40 => "X", // 




20 => "D", // _d
21 => "Y", // .y

60 => ".N", // \-/ (candrabindu)
61 => "_", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => ".a", // avagraha
64 => ".c", // \_/ (candra e)
65 => ".h", // \ (virama)
66 => "@", // abbreviation
67 => "`", // Latin apostrophe

68 => "^e", // 
69 => "^o", // 



74 => "^K",

);

$ch['unicode'] = array(

30 => "ǣ", // 
31 => "æ", // 
29 => "ô", // ae
32 => "n̆g", //
33 => "n̆j", // 
34 => "n̆ḍ", // 
35 => "n̆d", // 
36 => "m̆b", // 

37 => "ｑ", // 
38 => "k̲h", // 
39 => "ġ", // 

42 => "r̤h", // 
41 => "r̤", // 
43 => "̤", // 
44 => "%ḷ%", // .l
45 => "%ḹ%", // _.l

50 => "%%ḍ%%", // _D
51 => "ẏ", // .Y

70 => "ḻ",
71 => "ḽ",
72 => "ṟ",
73 => "ṉ",


1 => "ā", // _a
2 => "ī", // _i
3 => "ū", // _u
16 => "ḹ", // _.l
15 => "ḷ", // .l
5 => "ṝ", // _.r
4 => "ṛ", // .r
6 => "ṅ", // 'n
7 => "ñ", // ~n
8 => "ṭ", // .t
9 => "ḍ", // .d 
10 => "ṇ", // .n
11 => "ś", // 's
12 => "ṣ", // .s
13 => "ṁ", // 'm (anusvara)
14 => "ḥ", // .h (visarga)
40 => "ż", // 

20 => "ḏ", // _d
21 => "ẏ", // .y

60 => "m̐", // \-/ (candrabindu)
61 => "̮", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "ɱ", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "…", // abbreviation
67 => "’", // Latin apostrophe

68 => "ĕ", // 
69 => "ŏ", // 

74 => "ḵ",

);

$ch['unicode2'] = array(


30 => "ǣ", // 
31 => "æ", // 
29 => "ô", // ae
32 => "n̆g", //
33 => "n̆j", // 
34 => "n̆ḍ", // 
35 => "n̆d", // 
36 => "m̆b", // 

37 => "ｑ", 
38 => "k̲h", // 
39 => "ġ", // 

42 => "ṛh", // 
41 => "ṛ", // 
43 => "̤", // 
44 => "%l̥%", // .l
45 => "%l̥̄%", // _.l

50 => "%Ḏ%", // _D
51 => "ẏ", // .Y

70 => "ḻ",
71 => "ḷ",
72 => "ṟ",
73 => "ṉ",


1 => "ā", // _a
2 => "ī", // _i
3 => "ū", // _u
16 => "l̥̄", // _.l
15 => "l̥", // .l
5 => "r̥̄", // _.r
4 => "r̥", // .r
6 => "ṅ", // 'n
7 => "ñ", // ~n
8 => "ṭ", // .t
9 => "ḍ", // .d 
10 => "ṇ", // .n
11 => "ś", // 's
12 => "ṣ", // .s
13 => "ṁ", // 'm (anusvara)
14 => "ḥ", // .h (visarga)
40 => "ż", // 

20 => "ḏ", // _d
21 => "ẏ", // .y

60 => "m̐", // \-/ (candrabindu)
61 => "̮", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "ɱ", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "…", // abbreviation
67 => "’", // Latin apostrophe

68 => "ĕ", // 
69 => "ŏ", // 

74 => "ḵ",

);


$ch['velthuis'] = array(

30 => "^^ae", // 
31 => "^ae", // 
29 => "^^o", // ae
32 => "*g", // 
33 => "*j", // 
34 => "*D", // 
35 => "*d", // 
36 => "*b", // 
37 => "qh", // 
38 => "khh", // 
39 => "ghh", // 

42 => "rhh", // 
41 => "Dhh", // 
43 => "Q", // .h (visarga)
44 => "##.l", // .l
45 => "##.L", // _.l

50 => "%.d%", // _D
51 => ".y", // .Y

70 => "_l",
71 => ",l",
72 => "_r",
73 => "_n",

1 => "aa", // _a
2 => "ii", // _i
3 => "uu", // _u
16 => ".ll", // _.l
15 => ".l", // .l
5 => ".rr", // _.r
4 => ".r", // .r
6 => "\"n", // 'n
7 => "~n", // ~n
8 => ".t", // .t
9 => ".d", // .d 
10 => ".n", // .n
11 => "\"s", // 's
12 => ".s", // .s
13 => ".m", // 'm (anusvara)
14 => ".h", // .h (visarga)
40 => "x", //

20 => ".d", // _d
21 => ".y", // .y

60 => "~m", // \-/ (candrabindu)
61 => "_", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => ".a", // avagraha
64 => "k.c", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "@", // abbreviation
67 => "`", // Latin apostrophe

68 => "^e", // 
69 => "^o", // 

74 => "_k",

);

$ch['cologne'] = array(


30 => "AE", // AE
31 => "aE", // ae
29 => "aO", // ae

32 => "*g", // 
33 => "*j", //
34 => "*D", // 
35 => "*d", // 
36 => "*b", // 
37 => "qh", // 
38 => "khh", // 
39 => "ghh", // 

41 => "Dhh", // 
42 => "rhh", // 
43 => "Q", // .h (visarga)
44 => "%L", // .l
45 => "%W", // _.l

50 => "%P", // _D
51 => "%Y", // .Y

70 => "Z",
71 => "L",
72 => "r2",
73 => "n2",


1 => "A", // _a
2 => "I", // _i
3 => "U", // _u
16 => "lRR", // _.l
15 => "lR", // .l
5 => "RR", // _.r
4 => "R", // .r
6 => "G", // 'n
7 => "J", // ~n
8 => "T", // .t
9 => "D", // .d 
10 => "N", // .n
11 => "z", // 's
12 => "S", // .s
13 => "M", // 'm (anusvara)
14 => "H", // .h (visarga)
40 => "x", // 

20 => "P", // _d
21 => "Y", // .y


60 => "~", // \-/ (candrabindu)
61 => "_", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "~", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "@", // abbreviation
67 => "`", // Latin apostrophe

68 => "E", // 
69 => "O", // 

74 => "K",

);

/* Scripts default to HK */

$ch['bengali'] = $ch['hk'];
$ch['devanagari'] = $ch['hk'];
$ch['oriya'] = $ch['hk'];
$ch['telugu'] = $ch['hk'];
$ch['dtamil'] = $ch['hk'];
$ch['dtamil2'] = $ch['hk'];
$ch['malayalam'] = $ch['hk'];
$ch['kannada'] = $ch['hk'];
$ch['sinhala'] = $ch['hk'];
$ch['tibetan'] = $ch['hk'];
$ch['egrantha'] = $ch['hk'];
$ch['gujarati'] = $ch['hk'];
$ch['saurashtra'] = $ch['hk'];
$ch['punjabi'] = $ch['hk'];
$ch['oriya'] = $ch['hk'];
$ch['tamil-grantha'] = $ch['hk'];  
$ch['brahmi'] = $ch['hk'];  
$ch['assamese'] = $ch['hk']; 
$ch['burmese'] = $ch['hk']; 
$ch['khmer'] = $ch['hk']; 
$ch['thai'] = $ch['hk']; 
$ch['urdu'] = $ch['hk']; 
$ch['arabic'] = $ch['hk']; 

/* Super Numerals Used for diacritic purposes */

$SuperNumeral = array("¹","²","³","⁴","‥","·","಼");
$SuperNumeralNM = array("ʼ","ˇ","˘");

/* Indic Scripts */

$indic_scripts = array("bengali", "devanagari", "oriya","telugu", "dtamil", "malayalam", "kannada","sinhala","tibetan","egrantha","gujarati","saurashtra","punjabi","oriya","tamil-grantha","brahmi","dtamil2","assamese","burmese","khmer","thai","urdu","arabic");
?>