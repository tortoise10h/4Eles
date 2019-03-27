<?php
    //LOAD CONFIG
    require_once 'config/config.php';

    //LOAD HELPERS
    require_once 'helpers/session_helpers.php';

    //AUTO LOAD CORE FILE
    spl_autoload_register(function($className){
        require_once 'cores/' . $className . '.php';
    });

?>