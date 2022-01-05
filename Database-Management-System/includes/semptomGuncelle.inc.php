<?php 
    $tcno = $_POST['tcno'];
    $hastalik = $_POST['hastalik'];
    $guncelsemptom = $_POST['guncelsemptom'];
    $yenisemptom = $_POST['yenisemptom'];

    if (empty($tcno) || empty($hastalik) || empty($guncelsemptom) || empty($yenisemptom)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnobosguncelle&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnouzunlukguncelle&tcno=$tcno");
            exit();
        } else {
            $sql = "UPDATE match_d_symptom SET match_d_symptom.DISEASESYMPTOMID = '$yenisemptom' WHERE match_d_symptom.IDENTITYNO = '$tcno' AND match_d_symptom.DISEASEID = '$hastalik' AND match_d_symptom.DISEASESYMPTOMID = '$guncelsemptom';";
            mysqli_query($conn, $sql);

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=successsemptom&tcno=$tcno");
            exit(); 
        }
    }
?>