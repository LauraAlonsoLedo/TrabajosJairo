<?php
namespace App\Model;

class Vecino
{
    //Variables o atributos
    var $id;
    var $nombre;
    var $especie;
    var $personalidad;
    var $hobby;
    var $muletilla;
    var $imagen;

    function __construct($data=null){

        $this->id = ($data) ? $data->id : null;
        $this->nombre = ($data) ? $data->nombre : null;
        $this->especie = ($data) ? $data->especie : null;
        $this->personalidad = ($data) ? $data->personalidad : null;
        $this->hobby = ($data) ? $data->hobby : null;
        $this->muletilla = ($data) ? $data->muletilla : null;
        $this->imagen = ($data) ? $data->imagen : null;

    }

}
