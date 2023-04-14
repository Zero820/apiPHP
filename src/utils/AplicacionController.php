<?php
    class AplicacionController
    {
        private $_nombreEspacio = "Controller";
        private $_directorioController;
        private $_filtros = [];

        public function __construct() { 
            $this->_directorioController = __DIR__ . "/../../Controllers/";
        }

        public function EstablecerCabecera(string $cabecera){
            header($cabecera);
        }

        public function EstablecerFiltro(IFiltro $filtro){
            array_push($this->_filtros, $filtro);
        }

        public function Ejecutar()
        {
            $this->ejecutarFiltros();
            $this->ejecutarController();
        }

        private function ejecutarFiltros(): void{
            foreach ($this->_filtros as $filtro) {
                $filtro->Ejecutar();
            }
        }

        private function ejecutarController(): void{
            $controlador = $this->obtenerObjetoControlador();
            $instancia = $controlador->newInstance();
            $instancia->Ejecutar();
        }

        private function obtenerObjetoControlador() {
            $gestorUri = new GestorUri();
            $nombreControlador = $gestorUri->ObtnerSegmentoControlador();
            $nombreCompletoControlador = $nombreControlador.$this->_nombreEspacio;
            try
            {
                if(file_exists($this->_directorioController.$nombreCompletoControlador.".php")){
                    require_once $this->_directorioController.$nombreCompletoControlador.".php";
                    return new ReflectionClass($nombreCompletoControlador);
                }
                die('El controlador fisico no existe!');
            }
            catch (ReflectionException $Exception) 
            {
                die('El controlador no existe!');
            }
        }
    }