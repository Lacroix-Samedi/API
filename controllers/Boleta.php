<?php

namespace APIRest\controllers;

use APIRest\libs\Controller;
use APIRest\libs\Utils as Util;
use APIRest\models\BoletaModel;

class BoletaController extends Controller {
    private $id_boleta;
    private $rut;
    private $folio;
    private $fecha;
    private $monto;
    private $fecha_alta;
    private $fecha_baja;

    public function __construct() {
        parent::__construct();
        $this->model = new BoletaModel();
    }

    public function start(){
        $this->isAllow(array("GET", "POST"));
        $arguments = count($this->parameters) > 0 ? $this->parameters : [];
        switch($this->HTTPMethod) {
            case "GET":
                $result = $this->model->get($arguments);
                Util::JSONResponse(Util::encodeResponse(200, $result));
            break;
            case "POST": 
                $result = $this->model->post();
                $code = $result ? 201 : 400;
                Util::JSONResponse(Util::encodeResponse($code, []));
            break;
            default:
                Util::JSONResponse(Util::encodeResponse(404, [], "Metodo de solicitud no permitido {$this->HTTPMethod}"));
                exit;
        }
    }

}