<?php
    class GestorUri
    {
        private $_uri;

        public function __construct() {
            $this->_uri = new Uri();
        }

        public function ObtnerSegmentoControlador(): string 
        {
            return $this->_uri->SegmentoControlador();
        }

        public function ObtenerParametros(string $router): array
        {
            return $this->_uri->Parametros($router);
        }

        public function ObtenerCuerpo(): array
        {
            return $this->_uri->Cuerpo();
        }

        public function ObtenerVerbo(): string 
        {
            return $this->_uri->Verbo();
        }

        public function ValidarRouter(string $router): bool
        {
            return $this->_uri->Validar($router);
        }
    }