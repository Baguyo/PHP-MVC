<?php

    // LOad config
    require_once 'config/config.php';

    // LOAD HELPERS
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    
    //REQUIRE LIBRARIES
    // require_once "libraries/Core.php";
    // require_once "libraries/Controllers.php";
    // require_once "libraries/Database.php";
    
    // AutoLood core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
    }); 
 