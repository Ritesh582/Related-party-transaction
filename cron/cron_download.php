<?php
      ob_start();
      $filename="downloadjson.php";
      $output = shell_exec('ps axu | grep php');
      strpos($output,$filename);
      if(!strpos($output,$filename)){
      header("location: downloadjson.php");
      exit;
      }
