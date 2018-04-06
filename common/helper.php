<?php

if (!function_exists("custom_log")){
  function custom_log($message){
    if (!isset(CONFIG['logdir'])){
      error_log("Log file configuration not set");
    }
    $logfile = CONFIG["logdir"] . "/" . date('Ym') . ".log";
    if (false === error_log($message, 3, $logfile)){
      error_log("Error writing to log file");
    }
  }
}
