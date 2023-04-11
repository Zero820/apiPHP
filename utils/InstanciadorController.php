<?php
    class InstanciadorController
    {
        private $_nombreEspacio = "Controller";

        public function __construct() { }

        public function Ejecutar()
        {
            $controlador = $this->obtenerObjetoControlador();
            $instancia = $controlador->newInstance();
            $instancia->Ejecutar();
        }

        private function obtenerObjetoControlador() {
            $gestorUri = new GestorUri();
            $nombreControlador = $gestorUri->ObtnerSegmentoControlador();
            try
            {
                return new ReflectionClass($nombreControlador.$this->_nombreEspacio);
            }
            catch (ReflectionException $Exception) 
            {
                die('El controlador no existe!');
            }
        }
    }