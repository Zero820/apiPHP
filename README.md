# apiPHP
FrameWork minimo para hacer API´s en PHP.

### Arquitectura

- MVC

### Tecnología utilizada

- PHP 8.2

### ¿Como instalarlo?

- Descargar la carpeta apiPHP en el directorio donde ejecuta el servidor Apache o IIS (puede ser cuarquier servidor web que soporte PHP).
- En el caso de utilizar IIS se ha de instalar el modulo de redirección de páginas. Dirección de descarga: https://www.iis.net/downloads/microsoft/url-rewrite

### Como crear un controlador con distintos routers.

1. Crear un fichero EjemploController.php en la carpeta Controllers.
2. Definir dentro de EjemploController.php la clase EjemploController implementando la clase BaseController (el nombre de la clase siempre tiene que cumplir el nombre de espacio "Nombre"Controller).
```ruby
class EjemploController extends BaseController
```
3. Dentro de EjemploController.php definir una variable privada con las definiciones de los Routers a utilizar siguiendo la siguiente estructura:
```ruby
array(
        "ROUTER" => array("VERBO", "METODO");
);
```  
Ejemplo:
```ruby
private $_routes = array(
        ":param1/:param2" => array("verbo" => "GET", "metodo" => "ListarParametros"),
        "listar/entidad/:param1" => array("verbo" => "GET", "metodo" => "ListarParametros"),
        "guardar/:id" => array("verbo" => "POST", "metodo" => "GuardarConCabeceraYCuerpo"),
        "error" => array("verbo" => "PUT", "metodo" => "PeticionEjemploError")
);
```
** Donde:
- ":param1/:param2" => array("verbo" => "GET", "metodo" => "ListarParametros") corresponde a la siguiente URI en su verbo GET, http://localhost/apiPHP/1/12
- "listar/entidad/:param1" => array("verbo" => "GET", "metodo" => "ListarParametros") corresponde a la siguiente URI en su verbo GET, http://localhost/apiPHP/listar/entidad/1
- "guardar/:id" => array("verbo" => "POST", "metodo" => "GuardarConCabeceraYCuerpo") corresponde a la siguiente URI en su verbo POST, http://localhost/apiPHP/guardar/1
- "error" => array("verbo" => "PUT", "metodo" => "PeticionEjemploError") corresponde a la siguiente URI en su verbo PUT, http://localhost/apiPHP/error
4. En el constructor de la nueva clase EjemploController elevar la llamada al constructor base pasando como argumento la variable con la configuracion de los routers:
```ruby
public function __construct()
{ 
        parent::__construct($this->_routes);
}
```
5. En el fichero controlador EjemploController.php, crear las funciones correspondientes especificadas en el campo "metodo" de la declaracion de los routers. 
Las funciones reciben como parametros "Peticion" y "Respuesta".
```ruby
protected function ListarParametros(Peticion $peticion, Respuesta $respuesta): void
{
        $resultado = json_encode(
                array(
                        'metodo' => 'ListarParametros',
                        'Paramaetros-Cabecera' => $peticion->Parametros(),
                        'Parametros-Cuerpo' => $peticion->Cuerpo(),
                        'Campo multi valor' => array('Ejemplo 1' => 'patata 1', 'Ejemplo 2' => 'patata 2')
                )
        );
        // retornamos una respuesta al cliente en formato JSON.
        $respuesta->Enviar($resultado);
}
```
