<?php
    class GestorPeticion
    {
        private $_peticion;

        public function __construct(array $parametros, array $cuerpo)
        { 
            $this->_peticion = new Peticion($parametros, $cuerpo);
        }

        public function ObtenerPeticion(): Peticion
        {
            return $this->_peticion;
        }
    }