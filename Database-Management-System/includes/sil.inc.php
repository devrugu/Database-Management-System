<?php
    $tcno = $_POST['tcno'];

    if (empty($tcno)) {
        header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=tcnobossilme&tcno=$tcno");
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
        } else {
            //silme basarili
            $sql = "DELETE FROM employers WHERE IDENTITYNO='$tcno';";
            //Degisiklikler yapilacak
            $sqlSilmeSorgula = "SELECT * FROM employers WHERE IDENTITYNO='$tcno';";
            $resultSorgula = mysqli_query($conn, $sqlSilmeSorgula);
            $resultCheckSorgula = mysqli_num_rows($resultSorgula);
            if ($resultCheckSorgula > 0) {
                mysqli_query($conn, $sql);
                header("Location: ../calisanlariYonet/calisanlariGoruntule/Goruntule-sayfasi.php?signup=successsilme");

                
            } else{
                header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=veritabanı&tcno=$tcno");
            }
        }
    }
    
?>