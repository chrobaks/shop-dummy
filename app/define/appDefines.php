<?php
/**
 * Set APP PATH settings
 * --------------------------------------------- 
 */
define('APP_PATH', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('CORE_PATH', APP_PATH.'core'.DIRECTORY_SEPARATOR);
define('INC_PATH', APP_PATH.'inc'.DIRECTORY_SEPARATOR);
define('CONFIG_PATH', APP_PATH.'config'.DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH.'controller'.DIRECTORY_SEPARATOR);
define('MODEL_PATH', APP_PATH.'model'.DIRECTORY_SEPARATOR);
define('VIEW_PATH', APP_PATH.'view'.DIRECTORY_SEPARATOR);

/**
 * Set PUBLIC PATH settings
 * --------------------------------------------- 
 */
define('PUBLIC_PATH', str_replace('app', 'public', APP_PATH));
define('CSS_PATH', PUBLIC_PATH.'css'.DIRECTORY_SEPARATOR);
define('JS_PATH', PUBLIC_PATH.'js'.DIRECTORY_SEPARATOR);
define('IMAGE_PATH', PUBLIC_PATH.'image'.DIRECTORY_SEPARATOR);

define('CSS_URL', 'public/css/');
define('JS_URL', 'public/js/');
define('IMAGE_URL', 'public/image/');

/**
 * Set ENVIROMENT
 * ---------------------------------------------
 * develope   === developing and testing local server
 * production === production server 
 */
define('ENVIROMENT', ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') ? 'develope' : 'production');

/**
 * Set DATABASE settings
 * --------------------------------------------- 
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'seo_kueche');
define('DB_USER', 'seo_kueche');
define('DB_PASS', '!e3R_i.M96uZ_?');


