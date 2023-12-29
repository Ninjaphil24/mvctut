<?php 
if($uri =="/list" || $uri == "/listfa") include("components/listbuttons.php"); else if ($uri == "/singleuser" || $uri == "/singleuserfa" || preg_match("#^/singleuserfawc/([0-9]+)$#", $uri)) include("components/listbutton.php");

