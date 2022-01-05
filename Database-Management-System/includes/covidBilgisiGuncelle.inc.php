<?php
    $tcno = $_POST['tcno'];
    $asi = $_POST['asi'];
    $covidbaslangictarihi = $_POST['covidbaslangictarihi'];
    $covidbitistarihi = $_POST['covidbitistarihi'];
    //$kacgunsurdu = $_POST['kacgunsurdu'];
    $kacinci = $_POST['kacinci'];

    if (empty($tcno)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            if (empty($kacinci)) {
                header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=kacincibos&tcno=$tcno");
                exit();
            } else {
                if ($asi == "default") {
                    //devam et
                } else {
                    $sql = "UPDATE covidpatience SET covidpatience.VACCINEID = '$asi' WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID= '$kacinci';";
                    mysqli_query($conn, $sql);
                }
                if (empty($covidbaslangictarihi)) {
                    //devam et
                } else {
                    $sql = "UPDATE covidpatience SET covidpatience.CATCHCOVID = '$covidbaslangictarihi' WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID = '$kacinci';";
                    mysqli_query($conn, $sql);
                }
                if (empty($covidbitistarihi)) {
                    //devam et
                } else {
                    $sql = "UPDATE covidpatience SET covidpatience.ENDCOVID = '$covidbitistarihi' WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID = '$kacinci';";
                    mysqli_query($conn, $sql);
                }
                /*if (empty($kacgunsurdu)) {
                    //devam et
                } else {
                    $sql = "UPDATE covidpatience SET covidpatience.HOWLONG = '$kacgunsurdu' WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID = '$kacinci';";
                    mysqli_query($conn, $sql);
                }*/
                //update basarili

                header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=successguncellemecovid&tcno=$tcno");
                exit();
            }


            //covid bilgilerini güncelleyen SQL kodu gelecek
            //$sql = "UPDATE covidpatience SET covidpatience.CATCHCOVID = '$covidbaslangictarihi' , covidpatience.ENDCOVID = '$covidbitistarihi' , covidpatience.HOWLONG = '$kacgunsurdu' WHERE covidpatience.IDENTITYNO = '$tcno' AND covidpatience.HOWMANYCOVID = '$kacinci';";
            //mysqli_query($conn, $sql);
        }
      
    }
?>