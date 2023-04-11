<?php
    class GestorRespuesta
    {
        private $_respuesta;

        public function __construct()
        { 
            $this->_respuesta = new Respuesta();
        }

        public function ObtenerRespuesta(): Respuesta
        {
            return $this->_respuesta;
        }
    }