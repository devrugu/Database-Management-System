<?php
    $tcno = $_POST['tcno'];
    $asi = $_POST['asi'];
    $covidbaslangictarihi = $_POST['covidbaslangictarihi'];
    $covidbitistarihi = $_POST['covidbitistarihi'];
    //$kacgunsurdu = $_POST['kacgunsurdu'];
    $kacinci = $_POST['kacinci'];
    

    if (empty($tcno) || $asi == "default" || empty($covidbaslangictarihi) || 
        empty($covidbitistarihi) || empty($kacinci)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidBilgisiEkle-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidBilgisiEkle-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            //covid bilgilerini ekleyen SQL kodu gelecek
            $sql = "INSERT INTO covidpatience (IDENTITYNO,VACCINEID,CATCHCOVID,ENDCOVID, HOWMANYCOVID) VALUES('$tcno', '$asi', '$covidbaslangictarihi', '$covidbitistarihi', '$kacinci');";
            mysqli_query($conn, $sql);

            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidBilgisiEkle-sayfasi.php?signup=successcovid");
            exit();
        }
      
    }
?>