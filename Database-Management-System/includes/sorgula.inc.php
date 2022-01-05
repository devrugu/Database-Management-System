<?php
    session_start();
    $sqlsorgula = $_POST['sqlsorgula'];

    if (empty($sqlsorgula)) {
        header("Location: ../SQLsorgula/SqlSorgula-sayfasi.php?signup=sqlbos");
        exit();
    } else {
        $sql = "$sqlsorgula";
        $_SESSION['sql'] = $sql;
        header("Location: ../SQLsorgula/SqlSorgula-sayfasi2.php");
    }
?>