<?php
function solo_numeros($enter){
    $regex ='/[0-9]/';
    return preg_match($regex,$enter);
}

function solo_letras($enter){
    $regex ='/[a-zA-Z]/';
    return preg_match($regex,$enter);
}

function email($enter){
    return filter_var($enter, FILTER_VALIDATE_EMAIL);
}

if (isset($_POST['enviar'])) {

        if (solo_numeros($_POST['cp']) == 0) {
            echo 'codigo postal no valido';
        }
        if (email($_POST['email']) == False) {
            echo 'mail no valido';
        }

}