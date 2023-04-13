<?php
    class Uri
    {
        private $_segmentosUri;
        private $_posControlador = 2;
        private $_posRouter = 3;

        public function __construct() {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $this->_segmentosUri = $this->dividirCadena($uri, $this->_posRouter + 1);
        }

        public function SegmentoControlador(): string 
        {
            return $this->_segmentosUri[$this->_posControlador];
        }

        public function Validar(string $router): bool
        {
            $arrayRouter = $this->dividirCadena($router);
            if($this->compararNumeroSegmentos($arrayRouter) && $this->compararPath($arrayRouter))
            {
                return true;
            }
            return false;
        }

        public function Parametros(string $router): array
        {
            $paramatros = [];
            if($this->Validar($router))
            {
                $arrayRouter = $this->dividirCadena($router);
                $arrayPath = $this->SegmentoPath();
                $indiceParamatro = $this->obtenerIncideComienzoParametros($arrayRouter);
                for ($posicion = $indiceParamatro; $posicion < count($arrayRouter); $posicion++)
                {
                    $paramatros[$arrayRouter[$posicion]] = $arrayPath[$posicion];
                }
            }
            return $paramatros;
        }

        public function Cuerpo(): array
        {
            if ($_SERVER['REQUEST_METHOD'] !== "GET") {
                $postData = $_POST ?: null;
                $rawData = file_get_contents("php://input");
                $jsonData = !empty($rawData) ? json_decode($rawData, true) : null;
            
                return $jsonData ?? $postData ?? [];
            }
            return [];
        }

        public function Verbo(): string 
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        private function SegmentoPath(): array 
        {
            return $this->dividirCadena($this->_segmentosUri[$this->_posRouter] ?? '');
        }

        private function compararNumeroSegmentos(array $router): bool
        {
            return count($this->SegmentoPath()) == count($router);
        }
        
        private function compararPath(array $router): bool
        {
            $arrayPath = $this->SegmentoPath();
            $indiceMaximo = $this->obtenerIncideComienzoParametros($router);
            $routerSinParametros = array_slice($router, 0, $indiceMaximo);
            $pathSinParametros = array_slice($arrayPath, 0, $indiceMaximo);
            return empty(array_diff($routerSinParametros, $pathSinParametros));
        }

        private function obtenerIncideComienzoParametros(array $router): int
        {
            $tmpIndice = -1;
            foreach ($router as $indice => $segmento)
            {
                if ($tmpIndice === -1 && strpos($segmento, ":") !== false)
                {
                    $tmpIndice = $indice;
                }
            }
            return ($tmpIndice == -1) ? count($router) : $tmpIndice;
        }

        private function dividirCadena(string $cadena, int $limite = -1): array{
            return ($limite == -1) ? explode('/', $cadena) : explode('/', $cadena, $limite);
        }
    }