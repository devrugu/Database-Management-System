<?php
    session_start();
?>

<?php
    $tcno = $_POST['tcno'];
    $_SESSION['tcno3'] = $tcno;
    

    if (empty($tcno)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikBilgisiGoruntule-sayfasi.php?signup=tcnobosgoruntuleme&tcno=$tcno");
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikBilgisiGoruntule-sayfasi.php?signup=tcnouzunlukgoruntuleme&tcno=$tcno");
        } else {
            //Tüm hastalık bilgilerini listeleyen SQL kodu lazım (sql2 içine yazılacak)
            $sql2 = "SELECT employers.NAME,employers.SURNAME,diseases.DISEASENAME,diseasedrugs.DRUGNAME,match_d_drug.D_DRUGDOSE FROM employers,diseases,diseasedrugs,matchdisease,match_d_drug WHERE employers.IDENTITYNO = matchdisease.IDENTITYNO AND matchdisease.DISEASEID = diseases.DISEASEID AND matchdisease.IDENTITYNO = match_d_drug.IDENTITYNO AND match_d_drug.DISEASEDRUGID = diseasedrugs.DISEASEDRUGID AND matchdisease.DISEASEID = match_d_drug.DISEASEID AND employers.IDENTITYNO = '$tcno';";
            $_SESSION['sql2'] = $sql2;

            $sql4 = "SELECT employers.NAME,employers.SURNAME, diseases.DISEASENAME,diseasesymptoms.DISEASESYMPTOM FROM employers,diseases,diseasesymptoms,matchdisease,match_d_symptom WHERE employers.IDENTITYNO = matchdisease.IDENTITYNO AND matchdisease.IDENTITYNO = match_d_symptom.IDENTITYNO AND matchdisease.DISEASEID = diseases.DISEASEID AND matchdisease.DISEASEID = match_d_symptom.DISEASEID AND match_d_symptom.DISEASESYMPTOMID = diseasesymptoms.DISEASESYMPTOMID AND employers.IDENTITYNO = '$tcno'";
            $_SESSION['sql4'] = $sql4;

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php");
        }
    }
?>