<?php
    class Respuesta
    {
        public function __construct() { }

        public function Enviar(mixed $datosJSON, $httpHeader = "HTTP/1.1 200 OK"): void
        {
            $this->EnviarRespuesta(
                $datosJSON, 
                array('Content-Type: application/json', $httpHeader)
            );
        }
        
        public function Error(string $mensaje, string $httpHeader = "HTTP/1.1 422 Unprocessable Entity"): void
        {
            $this->enviarRespuesta(
                json_encode(array('error' => $mensaje)), 
                array('Content-Type: application/json', $httpHeader)
            );
        }

        private function EnviarRespuesta(mixed $datosJSON, array $httpHeaders = array()): void
        {
            header_remove('Set-Cookie');
            if (is_array($httpHeaders) && count($httpHeaders))
            {
                foreach ($httpHeaders as $httpHeader)
                {
                    header($httpHeader);
                }
            }
            echo $datosJSON;
            exit;
        }
    }