<?php
    session_start();
?>

<?php
    $tcno = $_POST['tcno'];
    $_SESSION['tcno4'] = $tcno;
    

    if (empty($tcno)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidBilgisiGoruntule-sayfasi.php?signup=tcnobosgoruntuleme&tcno=$tcno");
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidBilgisiGoruntule-sayfasi.php?signup=tcnouzunlukgoruntuleme&tcno=$tcno");
        } else {
            //covid bilgisi görüntüle sql kodu gelecek
            $sql2 = "SELECT covidpatience.IDENTITYNO, employers.NAME, employers.SURNAME , vaccines.VACCINENAME,covidpatience.CATCHCOVID,covidpatience.ENDCOVID,DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID) 
            AS HOWLONG, covidsymptoms.COVIDSYMPTOM,matchcovidsymptom.HOWMANYCOVID FROM employers,matchcovidsymptom,covidsymptoms,covidpatience,vaccines 
            WHERE employers.IDENTITYNO = matchcovidsymptom.IDENTITYNO AND matchcovidsymptom.COVIDSYMPTOMID = covidsymptoms.COVIDSYMPTOMID 
            AND vaccines.VACCINEID = covidpatience.VACCINEID AND covidpatience.IDENTITYNO = matchcovidsymptom.IDENTITYNO 
            AND covidpatience.HOWMANYCOVID = matchcovidsymptom.HOWMANYCOVID AND covidpatience.IDENTITYNO = '$tcno';";
            $_SESSION['sql2'] = $sql2;
            //covid temaslı bilgileri görüntüle sql kodu gelecek
            $sql4 = "SELECT employers.NAME,employers.SURNAME, employers.IDENTITYNO FROM employers,contactemployer WHERE employers.IDENTITYNO = contactemployer.CONTACTIDENTITYNO AND  contactemployer.IDENTITYNO = '$tcno';";
            $_SESSION['sql4'] = $sql4;



            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php");
        }
    }
    //DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID)   covidpatience.HOWLONG
?>
