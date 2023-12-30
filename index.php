<?php

spl_autoload_register(function ($class) {
    require_once ('generated-classes/' . $class . '.php');
});


require_once ('vendor/autoload.php');
require_once ('generated-conf/config.php');

use Propel\Runtime\Propel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));
$defaultLogger->pushHandler(new \Monolog\Handler\StreamHandler('php://output', Logger::DEBUG));
$serviceContainer->setLogger('defaultLogger', $defaultLogger);

require_once ('controller.php');

?>
