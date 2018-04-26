<?php


//Modificado

// Varios defines para los parámetros de configuración de acceso a la BD y la URL desde la que se sirve la aplicación
define('BD_HOST', 'localhost');
define('BD_NAME', 'allart');
define('BD_USER', 'admin');
define('BD_PASS', 'foo2aipheCah');
define('RAIZ_APP', __DIR__);
define('RUTA_APP', '/allart/');
define('RUTA_IMGS', RUTA_APP.'img/');
define('RUTA_CSS', RUTA_APP.'css/');
define('RUTA_JS', RUTA_APP.'js/');
define('INSTALADA', true );

if (! INSTALADA) {
  echo "La aplicación no está configurada";
  exit();
}


/* NUESTRO .old
*define('EJEMPLO', 'index.php');
*/




/* */
/* Configuración del charset */
/* */

/* Enlaces de interés para el soporte de UTF-8:
 * https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql
 * https://allseeing-i.com/how-to-setup-your-php-site-to-use-utf8
 * http://www.instantshift.com/2014/10/29/mbstring-and-php/
 *
 * Una vez configurado hay que asegurarse de especificar la codificación 'UTF-8' en las funciones 
 * que tengan un parámetro charset (en PHP >= 5.6 suelen tomar el valor 'UTF-8' por defecto, 
 * pero en versiones anteriores no) y utilizar las funciones http://php.net/manual/en/book.mbstring.php.
 */

/*
 * PHP >= 5.6
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

/*
 * PHP < 5.6

// internal/script encoding.
mb_internal_encoding('UTF-8');
// Language for internal character representation
mb_language('uni');
// HTTP input encoding (requests)
mb_http_input('UTF-8');

// HTTP output encoding.
mb_http_output('UTF-8');
// Fuerza la codificación de la salida del script a charset especificado en http_output
ob_start('mb_output_handler');
mb_regex_encoding('UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
*/

/**
 * Función para autocargar clases PHP.
 *
 * @see http://www.php-fig.org/psr/psr-4/
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'es\\ucm\\fdi\\aw\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/* */
/* Inicialización del objeto aplicacion */
/* */
$app = \es\ucm\fdi\aw\Aplicacion::getSingleton();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS), RUTA_APP, RAIZ_APP);

