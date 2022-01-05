<?php
    include_once 'dbh.inc.php';
    $tcno = $_POST['tcno'];
    $hastaliklar = $_POST['hastaliklar'];
    $ilac = $_POST['ilac'];
    $doz = $_POST['doz'];

    if (empty($tcno) || $hastaliklar == "default" || 
        $ilac == "default" || empty($doz)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/ilacBilgisiEkleme/ilacBilgisiEkle-sayfasi.php?signup=empty&tcno=$tcno");
    } else {
        if (!preg_match("/[0-9]/", $tcno)) {

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/ilacBilgisiEkleme/ilacBilgisiEkle-sayfasi.php?signup=tcnokarakter&tcno=$tcno");
            exit();
        } else {
            if ((floor(log10($tcno) + 1) != 11)) {
                header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/ilacBilgisiEkleme/ilacBilgisiEkle-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
                exit();
            } else {
                //ilaç tablosuna bilgileri ekle
                $sql = "INSERT INTO match_d_drug (D_DRUGDOSE, DISEASEDRUGID, DISEASEID, IDENTITYNO) VALUES ('$doz', '$ilac', '$hastaliklar', '$tcno');";
                mysqli_query($conn, $sql);

                header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/ilacBilgisiEkleme/ilacBilgisiEkle-sayfasi.php?signup=successekleme");
            }
        }
    }
?>