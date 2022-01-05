<?php
    $tcno = $_POST['tcno'];
    $kacinci = $_POST['kacinci'];

    if (empty($tcno)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=tcnobossilme&tcno=$tcno");
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
        } else {
            //silme basarili
            $sql2 = "DELETE FROM matchcovidsymptom
            WHERE matchcovidsymptom.IDENTITYNO = '$tcno' AND matchcovidsymptom.HOWMANYCOVID = '$kacinci'";
            mysqli_query($conn, $sql2);
            $sql = "DELETE FROM covidpatience WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID = '$kacinci';";
            //$sql2 = "DELETE FROM contactemployer WHERE contactemployer.IDENTITYNO = '$tcno';";
            mysqli_query($conn, $sql);
            //mysqli_query($conn, $sql2);
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=successcovidsilme");

            //Degisiklikler yapilacak
            /*$sqlSilmeSorgula = "SELECT * FROM covidpatience WHERE IDENTITYNO='$tcno' AND HOWMANYCOVID='$kacinci';";
            $resultSorgula = mysqli_query($conn, $sqlSilmeSorgula);
            $resultCheckSorgula = mysqli_num_rows($resultSorgula);
            if ($resultCheckSorgula > 0) {
                mysqli_query($conn, $sql);
                mysqli_query($conn, $sql2);
                header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=successcovidsilme");

                
            } else{
                header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=veritabanıtcno&tcno=$tcno");
            }*/
        }
    }
?>