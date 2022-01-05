<?php
    session_start();
?>

<?php
    include_once 'dbh.inc.php';

    if (isset($_POST['add'])) {
        require "ekle.inc.php";
    }
    elseif (isset($_POST['view'])) {
        require "goruntule.inc.php";
    }
    elseif (isset($_POST['delete1'])) {
        require "sil.inc.php";
    }
    elseif (isset($_POST['update'])) {
        require "guncelle.inc.php";
    }
    elseif (isset($_POST['delete2'])) {
        require "sil2.inc.php";
    }
?>