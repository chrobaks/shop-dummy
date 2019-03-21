<?php
/**
 * Debug Modus
 */
if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    error_reporting(E_ALL);
}

/**
 * Load Requires
 */
require_once 'app'.DIRECTORY_SEPARATOR.'define'.DIRECTORY_SEPARATOR.'appDefines.php';
require_once INC_PATH.'autoloader.inc.php';

/**
 * Start Session
 */
AppSession::startSession();

/**
 * Instance Index controller
 */
$IndexController = IndexController::get_instance($appConfig);

/**
 * Set view if is page route
 * else set ajax request
 */
if ($IndexController->setRouteController()) {

    
    $view = $IndexController->getView();
    // echo '<pre>';
    // var_dump($view);
    // echo '</pre>';

    include_once VIEW_PATH.$view['appTpl'].'.php';

} else {

    $IndexController->setRequestController();

}
