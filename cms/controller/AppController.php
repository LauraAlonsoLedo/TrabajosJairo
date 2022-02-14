<?php
namespace App\Controller;

use App\Model\Vecino;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;


class AppController
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

    public function index(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM vecinos ORDER BY id ASC");

        //Asigno resultados a un array de instancias del modelo
        $vecinos = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($vecinos,new Vecino($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "index", $vecinos);
    }

    public function acercade(){

        //Llamo a la vista
        $this->view->vista("app", "acerca-de");

    }

    public function vecinos(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM vecinos ORDER BY id ASC ");

        //Asigno resultados a un array de instancias del modelo
        $vecinos = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($vecinos,new Vecino($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "vecinos", $vecinos);

    }

    public function vecino($slug){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM vecinos WHERE id='$slug' LIMIT 1");

        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $vecino = new Vecino($row);

        //Llamo a la vista
        $this->view->vista("app", "vecino", $vecino);

    }
}