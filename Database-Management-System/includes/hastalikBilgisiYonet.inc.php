<?php
    session_start();
?>

<?php
    include_once 'dbh.inc.php';

    if (isset($_POST['add'])) {
        require "hastalikBilgisiEkle.inc.php";
    }
    elseif (isset($_POST['view'])) {
        require "hastalikBilgisiGoruntule.inc.php";
    }
    elseif (isset($_POST['delete'])) {
        require "hastalikBilgisiSil.inc.php";
    }
    elseif (isset($_POST['update1'])) {
        require "hastalikBilgisiGuncelle.inc.php";
    }
    elseif (isset($_POST['update2'])) {
        require "ilacBilgisiGuncelle.inc.php";
    }
    elseif (isset($_POST['update3'])) {
        require "semptomGuncelle.inc.php";
    }
?>