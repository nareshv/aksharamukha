<?php

// Scrapting HTML from the given URL


function web_transliterater($url)

{

    $url=str_replace(" title=","",$url);

    $ch = curl_init($url);

    $timeout = 0; // set to zero for no timeout

    $useragent="Aksharamukha - Indic Transliterator - http://www.virtualvinodh.com/aksharamukha"; // Setting User Agent String

    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT,        $timeout);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $data = curl_exec($ch);

    $baseurl = preg_replace('~(https*://)([^/]+)/*.*~i', '\\1\\2', $url);
    $baseurl = str_replace('‍','',$baseurl);

    // Replace relative paths with absolute paths

    $data=preg_replace("@(\")/@","$1$baseurl/",$data);
    $data=preg_replace("@(\.\")/@","$1$baseurl/",$data);
    $data=preg_replace("@(url\()\/@","$1$baseurl/",$data);

    // GET parameters into URL

    $getparam = array();
    $getvalue = array();

    $webparam="";

    if(!empty($_GET['tgt'])) $vars = $_SESSION;

    else $vars = $_POST;

    foreach($vars as $key=>$value)

    {

        $getparam[]= $key;
        $getvalue[]= $value;
    }

    $i=0;

    //print_r($getparam);
    //print_r($getvalue);

    for($i = 0 ; $i < count($getparam) ; $i++)

    {

        if($getparam[$i] != "website" && $getparam[$i] != "convert")

        {

            //echo $i;
            //echo $getparam[$i];
            //echo $getvalue[$i];

            $webparam=$webparam.$getparam[$i]."=".$getvalue[$i]."&";

        }
    }

    //echo $webparam;

    $transurl = "http://www.virtualvinodh.com/aksharamkh/aksharamukha-web.php?".$webparam."website=";

    //echo $webparam;

    // Explode

    $urlparts=explode("/",$url);

    $doubledot="";

    for ($i=0; $i<count($urlparts)-2 ; $i++) {
        $doubledot=$doubledot.$urlparts[$i]."/";
    }

    $data=str_replace("../",$doubledot,$data);

    //echo $url;

    if (strpos($url,'http://www.virtualvinodh.com/aksharamkh') == false ) {

        $data=preg_replace("@(<a href\=\"?)@","$1$transurl",$data);
        $data=preg_replace("@(<a target\=\"\_blank\" href\=\")@","$1$transurl",$data);
        $data=preg_replace("@(<a target\=\"\_self\" href\=\")@","$1$transurl",$data);

    }

    //$data=str_replace("http://www.virtualvinodh.com/aksharamkh/aksharamukha.php?website=http://www.virtualvinodh.com/beta/aksharamkh/aksharamukha-web.php?","http://www.virtualvinodh.com/beta/aksharamkh/aksharamukha.php?",$data);

    //$data=str_replace("http://www.virtualvinodh.com/beta/aksharamkh/aksharamukha.php?website=\"http://www.virtualvinodh.com/beta/aksharamkh/aksharamukha.php?","http://www.virtualvinodh.com/beta/aksharamkh/aksharamukha.php?",$data);

    $data=str_replace("\" title=\""," title=\"",$data);

    $data=preg_replace("@(http://www\.virtualvinodh\.com/aksharamkh/aksharamukha-web\.php\?.*)(?=http://www\.virtualvinodh\.com/aksharamkh/aksharamukha-web\.php\?website\=)@","",$data);

    //$data=preg_replace("@href=(?<!\")@","href=\"",$data);
    return $data;

}

// Scrape Redirected URLs

/*

function curl_redir_exec($ch,$debug="")
{
    static $curl_loops = 0;
    static $curl_max_loops = 20;

    if ($curl_loops++ >= $curl_max_loops) {
        $curl_loops = 0;

        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $debbbb = $data;
    list($header, $data) = explode("\r\n\r\n", $data, 2);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($http_code == 301 || $http_code == 302) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = @parse_url(trim(array_pop($matches)));
        //print_r($url);
        if (!$url) {
            //couldn't process the url to redirect to
            $curl_loops = 0;

            return $data;
        }
        $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
    /*    if (!$url['scheme'])
            $url['scheme'] = $last_url['scheme'];
        if (!$url['host'])
            $url['host'] = $last_url['host'];
        if (!$url['path'])
$url['path'] = $last_url['path'];*/
/*        $new_url = $url['scheme'] . '://' . $url['host'] . $url['path']; // . ($url['query']?'?'.$url['query']:'');
        curl_setopt($ch, CURLOPT_URL, $new_url);
    //    debug('Redirecting to', $new_url);
        return curl_redir_exec($ch);
    } else {
        $curl_loops=0;

        return $data;
    }
}

 */
