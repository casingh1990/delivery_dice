<?php

if (!function_exists("custom_log")){
  function custom_log($message){
    if (!isset(CONFIG['logdir'])){
      error_log("Log file configuration not set");
    }
    /**
     * @todo The following might be refactored to throw an error instead
     */
    if (!file_exists(CONFIG['logdir'])) {
      mkdir(CONFIG['logdir'], 0777, true);
    }
    $logfile = CONFIG["logdir"] . "/" . date('Ym') . ".log";
    if (false === error_log($message, 3, $logfile)){
      error_log("Error writing to log file");
    }
  }
}
