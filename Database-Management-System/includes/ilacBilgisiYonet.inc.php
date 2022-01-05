<?php
    session_start();
?>

<?php

    if (isset($_POST['add'])) {
        require "ilacBilgisiEkle.inc.php";
    }
?>