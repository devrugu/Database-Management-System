<?php
    

    include_once 'dbh.inc.php';

    if (isset($_POST['sorgula'])) {
        require "sorgula.inc.php";
    }
    elseif (isset($_POST['sorgula2'])) {
        require "sorgula2.inc.php";
    }
    

?>