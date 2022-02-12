<?php
namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\DbHelper;
use App\Model\Vecino;


class VecinoController
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    //Listado de vecinos
    public function index(){

        //Permisos
        $this->view->permisos("vecinos");

        //Recojo las vecinos de la base de datos
        $rowset = $this->db->query("SELECT * FROM vecinos ORDER BY id DESC");

        //Asigno resultados a un array de instancias del modelo
        $vecinos = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($vecinos,new Vecino($row));
        }

        $this->view->vista("admin","vecinos/index", $vecinos);

    }

    //Para activar o desactivar
    public function activar($id){

        //Permisos
        $this->view->permisos("vecinos");

        //Obtengo la vecino
        $rowset = $this->db->query("SELECT * FROM vecinos WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $vecino = new Vecino($row);

        if ($vecino->activo == 1){

            //Desactivo la vecino
            $consulta = $this->db->exec("UPDATE vecinos WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$vecino->nombre</strong> se ha desactivado correctamente.") :
                $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Activo la vecino
            $consulta = $this->db->exec("UPDATE vecinos WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$vecino->nombre</strong> se ha activado correctamente.") :
                $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");
        }

    }

    //Para mostrar o no en la home
    public function home($id){

        //Permisos
        $this->view->permisos("vecinos");

        //Obtengo la vecino
        $rowset = $this->db->query("SELECT * FROM vecinos WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $vecino = new Vecino($row);

        if ($vecino->home == 1){

            //Quito la vecino de la home
            $consulta = $this->db->exec("UPDATE vecinos WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$vecino->nombre</strong> ya no se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");
        }

        else{

            //Muestro la vecino en la home
            $consulta = $this->db->exec("UPDATE vecinos WHERE id='$id'");

            //Mensaje y redirección
            ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
                $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$vecino->nombre</strong> ahora se muestra en la home.") :
                $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");
        }

    }

    public function borrar($id){

        //Permisos
        $this->view->permisos("vecinos");

        //Obtengo la vecino
        $rowset = $this->db->query("SELECT * FROM vecinos WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $vecino = new Vecino($row);

        //Borro la vecino
        $consulta = $this->db->exec("DELETE FROM vecinos WHERE id='$id'");

        //Borro la imagen asociada
        $archivo = $_SESSION['public']."img/".$vecino->imagen;
        $texto_imagen = "";
        if (is_file($archivo)){
            unlink($archivo);
            $texto_imagen = " y se ha borrado la imagen asociada";
        }

        //Mensaje y redirección
        ($consulta > 0) ? //Compruebo consulta para ver que no ha habido errores
            $this->view->redireccionConMensaje("admin/vecinos","green","El vecino se ha borrado correctamente$texto_imagen.") :
            $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");

    }

    public function crear(){

        //Permisos
        $this->view->permisos("vecinos");

        //Creo un nuevo usuario vacío
        $vecino = new Vecino();

        //Llamo a la ventana de edición
        $this->view->vista("admin","vecinos/editar", $vecino);

    }

    public function editar($id){

        //Permisos
        $this->view->permisos("vecinos");

        //Si ha pulsado el botón de guardar
        if (isset($_POST["guardar"])){

            //Recupero los datos del formulario
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
            $especie = filter_input(INPUT_POST, "especie", FILTER_SANITIZE_STRING);
            $personalidad = filter_input(INPUT_POST, "personalidad", FILTER_SANITIZE_STRING);
            $hobby = filter_input(INPUT_POST, "hobby", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $muletilla = filter_input(INPUT_POST, "muletilla", FILTER_SANITIZE_STRING);
            //Genero slug (url amigable)
            $slug = $this->view->getSlug($nombre);

            //Imagen
            $imagen_recibida = $_FILES['imagen'];
            $imagen = ($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";
            $imagen_subida = ($_FILES['imagen']['name']) ? '/var/www/html'.$_SESSION['public']."img/".$_FILES['imagen']['name'] : "";
            $texto_img = ""; //Para el mensaje
            if ($id == "nuevo"){

                //Creo una nueva vecino
                $consulta = $this->db->exec("INSERT INTO vecinos 
                    (id, nombre, especie, personalidad, hobby, muletilla, imagen) VALUES 
                    ('$id','$nombre','$especie','$personalidad','$hobby','$slug','$imagen')");

                //Subo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                ($consulta > 0) ?
                    $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$nombre</strong> se creado correctamente.".$texto_img) :
                    $this->view->redireccionConMensaje("admin/vecinos","red","Hubo un error al guardar en la base de datos.");
            }
            else{

                //Actualizo la vecino
                $this->db->exec("UPDATE vecinos SET 
                    nombre='$nombre',especie='$especie',muletilla='$muletilla',
                    personalidad='$personalidad',hobby='$hobby',slug='$slug' WHERE id='$id'");

                //Subo y actualizo la imagen
                if ($imagen){
                    if (is_uploaded_file($imagen_recibida['tmp_name']) && move_uploaded_file($imagen_recibida['tmp_name'], $imagen_subida)){
                        $texto_img = " La imagen se ha subido correctamente.";
                        $this->db->exec("UPDATE vecinos SET imagen='$imagen' WHERE id='$id'");
                    }
                    else{
                        $texto_img = " Hubo un problema al subir la imagen.";
                    }
                }

                //Mensaje y redirección
                $this->view->redireccionConMensaje("admin/vecinos","green","El vecino <strong>$nombre</strong> se guardado correctamente.".$texto_img);

            }
        }

        //Si no, obtengo vecino y muestro la ventana de edición
        else{

            //Obtengo la vecino
            $rowset = $this->db->query("SELECT * FROM vecinos WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $vecino = new Vecino($row);

            //Llamo a la ventana de edición
            $this->view->vista("admin","vecinos/editar", $vecino);
        }

    }

}