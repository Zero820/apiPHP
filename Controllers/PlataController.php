<?php
    class PlataController extends BaseController
    {
        private $_routes = array(
            ":param1/:param2" => array("verbo" => "GET", "metodo" => "ListarParametros"),
            "listar/entidad/:param1" => array("verbo" => "GET", "metodo" => "ListarParametros"),
            "guardar/:id" => array("verbo" => "POST", "metodo" => "GuardarConCabeceraYCuerpo"),
            "error" => array("verbo" => "PUT", "metodo" => "PeticionEjemploError")
        );

        public function __construct()
        { 
            parent::__construct($this->_routes);
        }

        protected function ListarParametros(Peticion $peticion, Respuesta $respuesta): void
        {
            $resultado = json_encode(
                array(
                    'metodo' => 'ListarParametros',
                    'cabecera' => $peticion->Parametros(),
                    'cuerpo' => $peticion->Cuerpo(),
                    'Campo multi valor' => array('Ejemplo 1' => 'patata 1', 'Ejemplo 2' => 'patata 2')
                ),
            );
            $respuesta->Enviar($resultado);
        }

        protected function GuardarConCabeceraYCuerpo(Peticion $peticion, Respuesta $respuesta): void
        {
            $resultado = json_encode(
                array(
                    'metodo' => 'GuardarConCabeceraYCuerpo',
                    'cabecera' => $peticion->Parametros(),
                    'cuerpo' => $peticion->Cuerpo(),
                    'Campo multi valor' => array('Ejemplo 1' => 'patata 1', 'Ejemplo 2' => 'patata 2')
                ),
            );
            $respuesta->Enviar($resultado, 'HTTP/1.1 201 OK');
        }

        protected function PeticionEjemploError(Peticion $peticion, Respuesta $respuesta): void
        {
            $respuesta->Error("ESTO ES UN EJEMPLO DE COMO ENVIAR UN ERROR!");
        }
    }