<?php 
    $tcno = $_POST['tcno'];
    $guncelhastalik = $_POST['guncelhastalik'];
    $yenihastalik = $_POST['yenihastalik'];


    if (empty($tcno) || empty($yenihastalik) || empty($guncelhastalik)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnouzunlukguncelle&tcno=$tcno");
            exit();
        } else {
            $sql = "UPDATE matchdisease,match_d_drug,match_d_symptom SET matchdisease.DISEASEID = '$yenihastalik' , match_d_drug.DISEASEID = '$yenihastalik', match_d_symptom.DISEASEID = '$yenihastalik' WHERE matchdisease.IDENTITYNO= '$tcno' AND match_d_drug.IDENTITYNO = '$tcno' AND match_d_symptom.IDENTITYNO = '$tcno' AND matchdisease.DISEASEID = '$guncelhastalik' AND match_d_drug.DISEASEID =  '$guncelhastalik' AND match_d_symptom.DISEASEID =  '$guncelhastalik';";
            mysqli_query($conn, $sql);

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=successhastalik&tcno=$tcno");
            exit();  
        }
    }
?>