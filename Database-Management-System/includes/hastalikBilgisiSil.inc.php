<?php
    $tcno = $_POST['tcno'];
    $hastalik = $_POST['hastalik'];


    if (empty($tcno) || empty($hastalik)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnobosguncelle&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnouzunlukguncelle&tcno=$tcno");
            exit();
        } else {
            $sql = "DELETE FROM matchdisease WHERE matchdisease.IDENTITYNO = '$tcno' AND matchdisease.DISEASEID = '$hastalik';";
            mysqli_query($conn, $sql);

            $sql = "DELETE FROM match_d_drug WHERE match_d_drug.IDENTITYNO = '$tcno' AND match_d_drug.DISEASEID = '$hastalik';";
            mysqli_query($conn, $sql);

            $sql = "DELETE FROM match_d_symptom WHERE match_d_symptom.IDENTITYNO = '$tcno' AND match_d_symptom.DISEASEID = '$hastalik';";
            mysqli_query($conn, $sql);

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=successsilme&tcno=$tcno");
            exit(); 
        }
    }



?>