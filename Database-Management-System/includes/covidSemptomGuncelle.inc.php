<?php
    $tcno = $_POST['tcno'];
    $guncelcovidsemptom = $_POST['guncelcovidsemptom'];
    $yenicovidsemptom = $_POST['yenicovidsemptom'];
    $kacinci = $_POST['kacinci'];
    
    if (empty($tcno) || $guncelcovidsemptom == "default" || $yenicovidsemptom == "default") {
        header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            //covid semptom güncelleme SQL kodu gelecek

            $sql = "UPDATE matchcovidsymptom SET matchcovidsymptom.COVIDSYMPTOMID = '$yenicovidsemptom' WHERE matchcovidsymptom.IDENTITYNO = '$tcno' AND matchcovidsymptom.COVIDSYMPTOMID = '$guncelcovidsemptom' AND matchcovidsymptom.HOWMANYCOVID = '$kacinci';";
            mysqli_query($conn,$sql);
            
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=successcovidsemptom&tcno=$tcno");
            exit();
        }
    }

?>