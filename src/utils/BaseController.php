<?php
    class BaseController
    {
        private $_routers;

        protected function __construct(array $routers)
        {
            $this->_routers = $routers;
        }
        
        public function __call($name, $arguments)
        {
            $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
        }

        public function Ejecutar(): void
        {
            $gestorUri = new GestorUri();
            $gestorRespuesta = new GestorRespuesta();
            $respuesta = $gestorRespuesta->ObtenerRespuesta();
            foreach ($this->_routers as $router => $datos)
            {
                if($datos["verbo"] == $gestorUri->ObtenerVerbo() && $gestorUri->ValidarRouter($router) && $this->existeMetodo($datos["metodo"]))
                {
                    $gestorPeticion = new GestorPeticion($gestorUri->ObtenerParametros($router), $gestorUri->ObtenerCuerpo());
                    $this->{$datos["metodo"]}($gestorPeticion->ObtenerPeticion(), $respuesta);
                    exit;
                }
            }
            $respuesta->Error("No se encuentra una ruta valida con el verbo enviado.");
        }

        private function existeMetodo(string $metodo): bool
        {
            return method_exists($this, $metodo);
        }
    }