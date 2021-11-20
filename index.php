<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/CSSFormulario.css">
    <title>Document</title>
</head>
<?php
$_SESSION['provincias'] = [
    ['nombre' => "Almería", 'código' => "04"],
    ['nombre' => "Cádiz", 'código' => "11"],
    ['nombre' => "Córdoba", 'código' => "14"],
    ['nombre' => "Granada", 'código' => "18"],
    ['nombre' => "Huelva", 'código' => "21"],
    ['nombre' => "Jaén", 'código' => "23"],
    ['nombre' => "Málaga", 'código' => "29"],
    ['nombre' => "Huesca", 'código' => "22"],
    ['nombre' => "Teruel", 'código' => "44"],
    ['nombre' => "Zaragoza", 'código' => "50"],
    ['nombre' => "Asturias", 'código' => "33"],
    ['nombre' => "Islas Baleares", 'código' => "07"],
    ['nombre' => "Las Palmas", 'código' => "35"],
    ['nombre' => "Sta. Cruz de Tenerife", 'código' => "38"],
    ['nombre' => "Cantabria", 'código' => "39"],
    ['nombre' => "Ávila", 'código' => "05"],
    ['nombre' => "Burgos", 'código' => "09"],
    ['nombre' => "León", 'código' => "24"],
    ['nombre' => "Palencia", 'código' => "34"],
    ['nombre' => "Salamanca", 'código' => "37"],
    ['nombre' => "Segovia", 'código' => "40"],
    ['nombre' => "Soria", 'código' => "42"],
    ['nombre' => "Valladolid", 'código' => "47"],
    ['nombre' => "Zamora", 'código' => "49"],
    ['nombre' => "Albacete", 'código' => "02"],
    ['nombre' => "Ciudad Real", 'código' => "13"],
    ['nombre' => "Cuenca", 'código' => "16"],
    ['nombre' => "Guadalajara", 'código' => "19"],
    ['nombre' => "Toledo", 'código' => "45"],
    ['nombre' => "Barcelona", 'código' => "08"],
    ['nombre' => "Gerona", 'código' => "17"],
    ['nombre' => "Lérida", 'código' => "25"],
    ['nombre' => "Tarragona", 'código' => "43"],
    ['nombre' => "Alicante", 'código' => "03"],
    ['nombre' => "Castellón", 'código' => "12"],
    ['nombre' => "Valencia", 'código' => "46"],
    ['nombre' => "Badajoz", 'código' => "06"],
    ['nombre' => "Cáceres", 'código' => "10"],
    ['nombre' => "La Coruña", 'código' => "15"],
    ['nombre' => "Lugo", 'código' => "27"],
    ['nombre' => "Ourense", 'código' => "32"],
    ['nombre' => "Pontevedra", 'código' => "36"],
    ['nombre' => "Madrid", 'código' => "28"],
    ['nombre' => "Murcia", 'código' => "30"],
    ['nombre' => "Navarra", 'código' => "31"],
    ['nombre' => "Álava", 'código' => "01"],
    ['nombre' => "Vizcaya", 'código' => "48"],
    ['nombre' => "Guipúzcoa", 'código' => "20"],
    ['nombre' => "La Rioja", 'código' => "26"],
    ['nombre' => "Ceuta", 'código' => "51"],
    ['nombre' => "Melilla", 'código' => "52"]
];
?>
<body>
<h1>Formulario de Entrada de datos</h1>
<form action="logica.php" method="post">
    <table>
        <th rowspan="1">
            <td><h3>Datos del Formulario</h3></td>
        </th>
        <tr>
            <td><label>Nombre: </label></td>
            <td><input type="text" name="nombre"></td>
        </tr>
        <tr>
            <td><label>Apellidos: </label></td>
            <td><input type="text" name="apellidos"></td>
        </tr>
        <tr>
            <td><label>Dirección: </label></td>
            <td><input type="text" name="direccion"></td>
        </tr>
        <tr>
            <td><label>Ciudad: </label></td>
            <td><input type="text" name="direccion"></td>
        </tr>
        <tr>
            <td><label>Provincia: </label></td>
            <td><select>
                <?php
                foreach ($_SESSION['provincias'] as $provincias){
                    echo "<option value ='".$provincias['código']."'>".$provincias['nombre']."</option>";
                }
                ?></td>
        </tr>
        <tr>
            <td><label>Código Postal: </label></td>
            <td><input type="text" name ="cp"></td>
        </tr>
        <tr>
            <td><label>Teléfono: </label></td>
            <td><input type="text" name="telefono"></td>
        </tr>
        <tr>
            <td><label>Email: </label></td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td><label>Password: </label></td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><label>Web: </label></td>
            <td><input type="text" name="web"></td>
        </tr>
        <tr>
            <td><input type="submit" name="enviar" value="Enviar"><input type="reset" name="reiniciar" value="Reiniciar"></td>
        </tr>
    </table>
</form>
</body>
</html>