<?PHP

/* Processing time limit in seconds */

set_time_limit(5);

/* Intro text */

$intro_text = <<<CWS

ये धर्मा हेतुप्रभवा 
हेतून् तेषां तथागतो ह्यवदत् ।
तेषां च यो निरोध 
एवं वादी महाश्रमणः  ॥

               -- प्रतीत्यसमुत्पाद हृदय धारणी
                                                                  
CWS;



/* A list of available conversion options */

$convs = array (
	"dtamil" => "தமிழ்",
            "telugu" => "தெலுங்கு",
	"malayalam" => "மலையாளம்",
	"kannada" => "கன்னடம்",
	"devanagari" => "தேவநாகரி",
	"sinhala" => "சிங்களம்",
	"tibetan" => "திபெத்தியம்",
	"hk" => "Harward-Kyoto",
	"itrans" => "ITRANS",
	"unicode" => "IAST",
	"unicode2" => "ISO",
	"velthuis" => "Velthuis",
	"cologne" => "Cologne(Tamil)",
	"egrantha"=>"கிரந்தம் (இந்தோலிபி)"
);

/* And which ones among them are script? */


?>