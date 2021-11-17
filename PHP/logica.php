<?php
function solo_numeros($enter){
    $regex ="/([0-9]){5}/";
    return preg_match($regex,$enter);
}

function solo_letras($enter){
    $regex ='/[a-zA-Z]/';
    return preg_match($regex,$enter);
}

function email($enter){
    return filter_var($enter, FILTER_VALIDATE_EMAIL);
}

function contrasena($enter){
    $regex = "/((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^A-Za-z0-9])).{8,16}/";
    return preg_match($regex,$enter);
}

function web($enter){
    $regex = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
    return preg_match($regex,$enter);
}

if (isset($_POST['enviar'])) {

        if (solo_numeros($_POST['cp']) == 0) {
            echo  "codigo postal no valido <br>";
        }

        if (email($_POST['email']) == 0) {
            echo 'mail no valido <br>';
        }

        if (contrasena($_POST['psw']) == 0) {
            echo 'contraseña no valida <br>';
        }

       if(web($_POST['web']) == 0){
           echo 'web no valida <br>';
       }
}