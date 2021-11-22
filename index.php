<?php
//Creamos la funcion que nos extrae las provincias y sus codigos del txt externo
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
//Creamos un array para utilizarlo de base para evitar estar tecleando en los campos
$datos = ["David","Navarro","Calle Ejemplo","Mostoles","28932",123456789,"example@example.com","aB345678@","https://www.isepceu.es/"];

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/CSSFormulario.css">
    <title>Formulario</title>
</head>

<body>
<!-- Empezamos con la estructura del formulario -->

<h1>Formulario de Entrada de datos</h1>
<form action="PHP/logica.php" method="post">
    <table cellspacing="5">
        <th rowspan="1">
            <td><h3>Datos del Formulario</h3></td>
        </th>
        <tr>
            <td><label>Nombre: </label></td>
            <td><input type="text" name="nombre" value ='<?php echo $datos[0] ?>' required></td>
        </tr>
        <tr>
            <td><label>Apellidos: </label></td>
            <td><input type="text" name="apellidos" value ='<?php echo $datos[1] ?>' required></td>
        </tr>
        <tr>
            <td><label>Dirección: </label></td>
            <td><input type="text" name="direccion" value ='<?php echo $datos[2] ?>' required></td>
        </tr>
        <tr>
            <td><label>Ciudad: </label></td>
            <td><input type="text" name="ciudad" value ='<?php echo $datos[3] ?>' required></td>
        </tr>
        <tr>
            <td><label>Provincia: </label></td>
            <td><select name="Provincia">
                <?php
                //utilizamos un foreach para evitar crearnos muchas etiquetas option
                foreach (provincias() as $provincias){
                    ?> <option> <?php echo $provincias['nombre'];}?></option>  </select>
                </td>
        </tr>
        <tr>
            <td><label>Código Postal: </label></td>
            <td><input type="text" name ="cp" value ='<?php echo $datos[4] ?>' required></td>
        </tr>
        <tr>
            <td><label>Teléfono: </label></td>
            <td><input type="text" name="telefono" value ='<?php echo $datos[5] ?>' required></td>
        </tr>
        <tr>
            <td><label>Email: </label></td>
            <td><input type="text" name="email" value ='<?php echo $datos[6] ?>' required></td>
        </tr>
        <tr>
            <td><label>Password: </label></td>
            <td><input type="password" name="password" value ='<?php echo $datos[7] ?>' required></td>
        </tr>
        <tr>
            <td><label>Web: </label></td>
            <td><input type="text" name="web" value ='<?php echo $datos[8];?>' required></td>
        </tr>
        <tr>
            <td><input type="submit" name="enviar" value="Enviar"> </td> <td><input type="reset" name="reiniciar" value="Reiniciar"></td>


        </tr>
    </table>
</form>
</body>
</html>
