<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
    <link rel="stylesheet" href="../CSS/CSSFormulario.css">
</head>
<body>
<?php
//creamos una variable para saber si el formulario tiene algún error
$correcto = true;
//Y replicamos la misma funcion
function provincias()
{
    //Para ello nos creamos la variable a utilizar
    $provincias = [];
    //Y utilizamos la funcion file_get_contents para extraer los datos
    $string = file_get_contents("Provincias.txt");

    $array = explode("\n", $string);
    foreach ($array as $fila) {
        $item = explode(" ", $fila);
        $provincias[] = [
            'numero' => $item[1],
            'nombre' => str_replace("_", " ", $item[0])
        ];
    }
    //Devolvemos la variable que almacena los datos
    return $provincias;
}
//Definimos los patrones necesarios mas adelante
define("RENUM",'/[0-9]+/');
define("RELET",'/[a-zA-Z]+/');


// Y creamos una función que compruebe si el formato del número de teléfono es válido
function checkTelefono($telf){
    //llamamos a la variable global correcto
    global $correcto;
    //Y comprobamos si el valor introducido cumple los parámetros si no mandamos un mensaje de error y aplicamos correcto a falso
    if(preg_match(RELET,$telf)!=0){
        echo " <p class = 'err'> El teléfono no puede contener letras.</p>";
        $correcto = false;

    }else{
        //Ahora comprobamos que la longitud del valor sea exactamente igual a nueve de no ser así mandamos un mensaje de error y aplicamos correcto a falso
        if(strlen($telf)!=9){
            echo " <p class = 'err'> Tienes que introducir 9 números en el teléfono. </p>";
            $correcto = false;

        }
    }
}
// Y creamos una función que compruebe si el formato del código postal es válido
function checkCP($cp){
//llamamos a la variable global correcto
    global $correcto;
    // creamos una variable que almacene el valor de $_POST['cp'] con un valor string
    $cpf = strval($_POST['cp']);

    //Y comprobamos si el valor introducido cumple los parámetros si no mandamos un mensaje de error y aplicamos correcto a falso
    if(preg_match(RELET,$cp)!=0){
        echo " <p class = 'err'> El código postal no puede contener letras </p>";
        $correcto = false;
    }else {
        //Ahora comprobamos que la longitud del valor sea exactamente igual a nueve de no ser así mandamos un mensaje de error y aplicamos correcto a falso
        if (strlen($cp) != 5) {
            echo " <p class ='err'> Tienes que introducir 5 números en el código postal. </p>";
            $correcto = false;
        } else {
            //Ahora comprobaremos que el codigo de provincia corresponde con el principio del codigo postal
            foreach (provincias() as $provincias) {
                //primero debemos saber que provincia se ha marcado
                if ($provincias['nombre'] == $_POST['Provincia']) {
                    //Y después comprobar si se cumple o no las condiciones

                    if ($provincias['numero'] != substr($cpf, 0, 2)) {
                        echo " <p class ='err'> el codigo postal no corresponde con la Provincia seleccionada </p> ";
                        $correcto = false;

                    }
                }
            }
        }
    }

}
// Esta función comprueba si el valor está compuesto solo por números
function busca_numeros($enter){
    $regex ='/[0-9]+/';
    return preg_match($regex,$enter);
}
// Esta función comprueba si el valor está compuesto solo por números y letras
function letrasyNumeros($enter){
    global $correcto;
    $regex ='/[a-zA-Z0-9]+/';
    if (preg_match($regex,$enter) != 1){
        $correcto = false;
        echo " <p class ='err'> La direccion solo puede contener letras y numeros </p>";
    }
}
//Esta función comprueba si el valor introducido cumple con las reglas de formato de un email
function email($enter){
    global $correcto;
    if( filter_var($enter, FILTER_VALIDATE_EMAIL) == 0){
        $correcto = false;
        echo '<p class ="err"> Email no válido </p>';
    }
}
//Esta función comprueba si el valor introducido cumple con las siguientes condiciones:
//Al menos un número
//Al menos una mayúscula
//Al menos una minúscula
//Al menos un caracter especial
//Mínimo 8 caracteres
//Maximo 16 caracteres
function contrasena($enter){
    global $correcto;
    $regex = "/((?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^A-Za-z0-9])).{8,16}/";
    if (preg_match($regex,$enter) != 1) {
        $correcto = false;
        echo "<p class ='err'> Contraseña no válida. </p>";
    }
}
//Esta función comprueba si el valor introducido cumple con las reglas de formato de una página web
function web($enter){
    global $correcto;
    $regex = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
    if(preg_match($regex,$enter) == 0){
        $correcto = false;
        echo '<p class ="err"> Web no válida. </p>';

    }
}
//Si pulsamos el botón enviar
if (isset($_POST['enviar'])) {
//Comprueba que el nombre no tenga números
    if(busca_numeros($_POST['nombre']) != 0){
        $correcto = false;
        echo "<p class ='err'>El nombre no puede contener números. </p>";
    }
    //Comprueba que el apellido no tenga números
    if(busca_numeros($_POST['apellidos']) != 0){
        $correcto = false;
        echo "<p class ='err'> Los apellidos no pueden contener números. </p>";
    }
    //Comprueba que la ciudad no tenga números
    if(busca_numeros($_POST['ciudad']) != 0){
        $correcto = false;
        echo "<p class ='err'> La ciudad no puede contener números. </p>";
    }
// Y llamamos a las funciones con sus respectivos campos a comprobar
    email($_POST['email']);
    checkTelefono($_POST['telefono']);
    checkCP($_POST['cp']);
    letrasyNumeros($_POST['direccion']);
    contrasena($_POST['password']);
    web($_POST['web']);
// Si no ha habido ningún fallo se envia correctamente el formulario y se redireccionará a la pagina del formulario
    if($correcto == true ){
        ?>
        <div class ="final">  <h1 class ="b">Formulario enviado correctamente <br><br> <small>Se te redireccionará a la pagina del formulario en unos instantes</small></h1> <br>  <?php
            header("refresh:3;url= ../index.php"); ?>

        </div>
        <?php
        //Si ha habido fallos se mostraran y se tendrá la opción de volver ha introducir valores
    }else{
        ?>  <h1>Ha ocurrido un error</h1>
        <a href="../index.php"> Pulsa aqui para rellenar el formulario de nuevo</a> <?php
    }

}
?>
</body>
</html>

