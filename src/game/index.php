<?php
    
    // Incluimos el archivo de configuracion para el controlador por defecto y el metodo por defecto
    require_once 'app/config/config.php';

    // Si no le pasamos controlador ni metodo, le asignamos al $_GET un valor por defecto del config
    if(!isset($_GET['c'])) $_GET['c'] = CONTROLADOR_DEFECTO;
    if(!isset($_GET['m'])) $_GET['m'] = METODO_DEFECTO;

    // Concatenamos la ruta del controlador, esta ruta se encuentra en el config
    $rutaControlador = CONTROLLER_PATH . $_GET['c'] . '.php';

    // Incluimos el controlador para poder instanciarlo mas adelante
    require_once $rutaControlador;

    // Creamos el nombre de la clase del controlador poniendole una C delante
    $nombreControlador = 'C' . $_GET['c'];

    // Instanciamos el controlador
    $controlador = new $nombreControlador();
    
    // Indicamos $datos va a ser un array (es más explicativo que otra cosa)
    $datos = array();
    // Si el metodo existe en el controlador, ejecutamos el metodo y guardamos los datos que nos devuelve
    if(method_exists($controlador, $_GET['m'])) $datos = $controlador->{$_GET['m']}();

    // Incluimos la vista que nos devuelve el controlador para usar los datos que nos ha devuelto el metodo, esta ruta se encuentra en el config
    if(!empty($controlador->vista)){
        require_once VIEW_PATH . $controlador->vista . '.php';
    }    

?>