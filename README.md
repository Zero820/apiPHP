# apiPHP
Pequeño FrameWork para hacer API´s en PHP.

### Como utilizarlo

1. Crear un fichero Ejemplo.php en la carpeta Controllers.
2. Dar de alta en el fichero Ejemplo.php en /inc/ControllersColeccion.php.
```ruby
require_once __DIR__ . "/../Controllers/PlataController.php";
```
4. Definir dentro de Ejemplo.php la clase EjemploController implementando la clase BaseController (el nombre de la clase siempre tiene que cumplir el nombre de espacio "Nombre"Controller).
```ruby
class EjemploController extends BaseController
```
6. Dentro de Ejemplo.php definir una variable privada con las definiciones de los Routers a utilizar siguiendo la siguiente estrucuro:
        
```ruby
private $_routes = array(
        ":param1/:param2" => array("verbo" => "GET", "metodo" => "ListarParametros"),
        "listar/entidad/:param1" => array("verbo" => "GET", "metodo" => "ListarParametros"),
        "guardar/:id" => array("verbo" => "POST", "metodo" => "GuardarConCabeceraYCuerpo"),
        "error" => array("verbo" => "PUT", "metodo" => "PeticionEjemploError")
);
```
