<?php
    session_start();
?>

<?php
    include_once 'dbh.inc.php';

    if (isset($_POST['add'])) {
        require "covidBilgisiEkle.inc.php";
    }
    elseif (isset($_POST['add2'])) {
        require "covidSemptomEkle.inc.php";
    }
    elseif (isset($_POST['add3'])) {
        require "covidTemasliEkle.inc.php";
    }
    elseif (isset($_POST['delete'])) {
        require "CovidBilgisiSil.inc.php";
    }
    elseif (isset($_POST['temp'])) {
        require "guncelle.inc.php";
    }
    elseif (isset($_POST['view'])) {
        require "covidBilgisiGoruntule.inc.php";
    }
    elseif (isset($_POST['update'])) {
        require "covidBilgisiGuncelle.inc.php";
    }
    elseif (isset($_POST['update2'])) {
        require "covidSemptomGuncelle.inc.php";
    }
    elseif (isset($_POST['update3'])) {
        require "covidTemasliGuncelle.inc.php";
    }
?>