<?php
    $tcno = $_POST['tcno'];
    $kacincicovid = $_POST['kacincicovid'];
    $covidsemptomlar = $_POST['covidsemptomlar'];
    
    if (empty($tcno) || empty($kacincicovid) || empty($covidsemptomlar)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidSemptomEkle/covidSemptomEkle-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidSemptomEkle/covidSemptomEkle-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            //covid semptom ekleme SQL kodu gelecek

            foreach ($covidsemptomlar as $value) {
                $sql = "INSERT INTO matchcovidsymptom(IDENTITYNO,COVIDSYMPTOMID,HOWMANYCOVID) VALUES('$tcno', '$value', '$kacincicovid')";
                mysqli_query($conn,$sql);
            }

            

            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidSemptomEkle/covidSemptomEkle-sayfasi.php?signup=successcovidsemptom");
            exit();
        }
    }

?>