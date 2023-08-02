<?php


// if ( ! filter_var($_POST["code"], FILTER_VALIDATE_CODE)) {
//     die("Les chiffres saisis ne correspondent pas à votre code. Veuillez réessayer.");
// }



           
if ($_POST["code"]){

    header("Location: ../recover/password.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}








