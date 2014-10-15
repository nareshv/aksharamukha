<?PHP


//  Storing Options in Session

function cook($var)
{

    $varsel="{$var}"."_sel";

    if (!empty($_POST[$var])) {

        $_SESSION[$var]= $_POST[$var];
        $GLOBALS[$varsel]="checked";
    } else

    {

        $_SESSION[$var]=null;
        $GLOBALS[$varsel]  ="";

    }

}

function cookrad($var)

{

    $varsel1="{$var}"."1_sel";
    $varsel2="{$var}"."2_sel";

    if (!empty($_POST[$var])) {
        $_SESSION[$var]=$_POST[$var];
        if($_SESSION[$var]==1)
            $GLOBALS[$varsel1]="checked";
        if($_SESSION[$var]==2)
            $GLOBALS[$varsel2]="checked";

    } else {
        $_SESSION[$var]=null;  $GLOBALS[$varsel1]="";  $GLOBALS[$varsel2]="";
    }

}
