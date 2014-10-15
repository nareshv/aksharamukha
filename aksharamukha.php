<?PHP session_start();

if(!empty($_POST['website']))

{

    //header("Location: http://localhost/aksharamukha/aksharamukha.php?website=".($_POST['website']));

}

// Including Body in a separate file to avoid "Header Already Sent" message

include "Aksharamukha_body.php"
