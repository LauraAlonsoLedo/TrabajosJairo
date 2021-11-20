<?php
define("RENUM",'/[0-9]+/');
define("RELET",'/[a-zA-Z]+/');

function checkTelefono($telf){
    if(preg_match(RELET,$telf)!=0){
        echo "El teléfono no puede contener letras.<br>";
    }else{
        if(strlen($telf)!=9){
            echo "Tienes que introducir 9 números en el teléfono. <br>";
        }
    }
}
function checkCP($cp){
    if(preg_match(RELET,$cp)!=0){
        echo "El código postal puede contener letras <br>";
    }else{
        if(strlen($cp)!=9){
            echo "Tienes que introducir 5 números en el código postal. <br>";
        }
    }
}

function solo_numeros($enter){
    $regex ="/([0-9]){5}/";
    return preg_match($regex,$enter);
}

function busca_numeros($enter){
    $regex ='/[0-9]+/';
    return preg_match($regex,$enter);
}

function busca_letras($enter){
    $regex ='/[a-zA-Z]+/';
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
echo '<pre>';
//Mostrar todo el array
print_r($_POST);
echo '</pre>';
if (isset($_POST['enviar'])) {
    checkTelefono($_POST['telefono']);
    checkCP($_POST['cp']);
    if(busca_numeros($_POST['nombre']) != 0){
        echo "El nombre no puede contener números. <br>";
    }
    if(busca_numeros($_POST['apellidos']) != 0){
        echo "Los apellidos no pueden contener números. <br>";
    }
    if(busca_numeros($_POST['ciudad']) != 0){
        echo "La ciudad no puede contener números. <br>";
    }
    if (solo_numeros($_POST['cp']) == 0) {
        echo  "Código postal no válido. <br>";
    }
    if (email($_POST['email']) == 0) {
        echo 'Email no válido <br>';
    }
    if (contrasena($_POST['psw']) == 0) {
        echo 'Contraseña no válida. <br>';
    }
    if(web($_POST['web']) == 0){
        echo 'Web no válida. <br>';
    }
}

?>
