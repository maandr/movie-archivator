<?php
require_once 'app/core/util/Autoloader.php';

function autoloader($className) {
  $Autoloader = new Autoloader();

  $Autoloader->observe('');
  $Autoloader->observe('app/core/');
  $Autoloader->observe('app/core/database/');
  $Autoloader->observe('app/core/form/');
  $Autoloader->observe('app/core/mvc/');
  $Autoloader->observe('app/core/util/');
  $Autoloader->observe('app/models/');
  $Autoloader->observe('app/models/access/');
  $Autoloader->observe('app/models/user/');
  $Autoloader->observe('app/models/movies/');
  $Autoloader->observe('app/models/ratings/');
  $Autoloader->observe('libs/');
  $Autoloader->observe('libs/smarty/');
  $Autoloader->observe('libs/parsedown/');

  $Autoloader->load($className);
}

spl_autoload_register('autoloader');
?>
