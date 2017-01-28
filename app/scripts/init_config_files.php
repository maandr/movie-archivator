<?php
/* load config file */
$env = parse_ini_file("config/global.conf", TRUE);

/* application */
define('PROJECT_NAME', $env['application']['project_name']);
define('PORT', $env['application']['port']);
define('DEBUG_MODE', $env['application']['debug_mode']);
define('MAX_UPLOAD_SIZE',  $env['application']['debug_mode']);
define('TEMPLATE_COMPILE_DIR', $env['application']['tempalte_compile_directory']);

/* security */
define('LOCK_AFTER_LOGIN_ATTEMPTS', $env['security']['max_allowed_login_attempts']);
define('SESSION_SECRET', $env['security']['session_secret']);

/* mysql */
define('DB_TYPE', 'mysql');
define('MYSQL_HOSTNAME', $env['mysql']['hostname']);
define('MYSQL_USERNAME', $env['mysql']['username']);
define('MYSQL_PASSWORD', $env['mysql']['password']);
define('MYSQL_DATABASE', $env['mysql']['database']);

/* pathes */
define('ROOT_DIR', $env['pathes']['root']);
define('PATH_VIEWS_DIR', $env['pathes']['views']);
define('PATH_MODELS_DIR', $env['pathes']['models']);
define('PATH_CONTROLLERS_DIR', $env['pathes']['controllers']);
define('PATH_BACKUP_DIR', $env['pathes']['backup']);
define('PATH_TPL_INDEX', $env['pathes']['index_template']);
define('PATH_BACKEND_TPL_INDEX', $env['pathes']['backend_index_template']);
?>
