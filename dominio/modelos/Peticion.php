<?php
    class Peticion
    {
        private $_parametros;
        private $_cuerpo;

        public function __construct(array $parametros, array $cuerpo)
        { 
            $this->_parametros = $parametros;
            $this->_cuerpo = $cuerpo;
        }

        public function Parametros(): array
        {
            return $this->_parametros;
        }

        public function Cuerpo(): array
        {
            return $this->_cuerpo;
        }
    }