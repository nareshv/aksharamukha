<?PHP


// Pre-Correction : Textual Replacements made in Harvard Kyoto Encoded Text
// Post-Correction : Textual Replacements made in Unicode Indic Text

function transliterate($text,$source,$target)

{

    include "./diCrunch/diCrunch_config-en.php";
    include "./diCrunch/diCrunch_charsets.php";
    include "./diCrunch/diCrunch_preprocess.php";

    $text = stripslashes($text);

    if (!empty($text)) {
        $text = str_replace($ch[$source], $ch['hk'], $text);
        include "./diCrunch/diCrunch_Pre_Correction.php";
        $text = str_replace($ch['hk'], $ch[$target], $text);
    }

    include "./diCrunch/diCrunch_postprocess.php";

    /* Script cruncher */

    if (in_array($source, $indic_scripts)) {
        include "./diCrunch/diCrunch_{$source}.php";
        include "./diCrunch/diCrunch_indic_source.php";
        include "./diCrunch/diCrunch_Pre_Correction.php";
        $text = str_replace($ch['hk'], $ch[$target], $text);

    }

    if (in_array($target, $indic_scripts)) {
        include "./diCrunch/diCrunch_{$target}.php";
        include "./diCrunch/diCrunch_indic_target.php";

    }

    include "./diCrunch/diCrunch_Post_Correction.php";

    return $text;

}
