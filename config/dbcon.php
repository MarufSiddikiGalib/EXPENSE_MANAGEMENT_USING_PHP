<?php
     
    //   define("HOSTNAME", "localhost");
    //   define("USERNAME", "root");
    //   define("PASSWORD", "");
    //   define("DATABASE", "crud_operations");


    // database host
      if (!defined('HOSTNAME')) {
        define('HOSTNAME', 'localhost'); 
    }
    
    //  Database username
    if (!defined('USERNAME')) {
        define('USERNAME', 'root');
    }
    
    // Database password
    if (!defined('PASSWORD')) {
        define('PASSWORD', ''); 
    }
    
    // Database name
    if (!defined('DATABASE')) {
        define('DATABASE', 'expense');
    }

      $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if(!$con){
        die("Connection failed");
    }
    

    